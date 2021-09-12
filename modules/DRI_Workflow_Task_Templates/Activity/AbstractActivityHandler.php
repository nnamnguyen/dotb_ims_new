<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Abstract implementation of a Activity Handler.
 *
 * All OOTB handlers extends from this one.
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
abstract class AbstractActivityHandler implements ActivityHandlerInterface
{
    /**
     * @var string
     */
    protected $linkName;

    /**
     * @var string
     */
    protected $moduleName;

    /**
     * @var array
     */
    private $children;

    /**
     * {@inheritdoc}
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return \BeanFactory::newBean($this->moduleName);
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromTemplate(\DotbBean $activity, \DRI_Workflow_Task_Template $activityTemplate)
    {
        $activity->dri_workflow_task_template_id = $activityTemplate->id;
        $activity->dri_workflow_sort_order = $activityTemplate->sort_order;
        $activity->name = $activityTemplate->name;
        $activity->description = $activityTemplate->description;
        $activity->customer_journey_points = $activityTemplate->points;
        $activity->is_cj_parent_activity = $activityTemplate->is_parent;
        $activity->customer_journey_blocked_by = $activityTemplate->blocked_by;
        $activity->cj_url = $activityTemplate->url;
        $this->setActualSortOrder($activity);
    }

    /**
     * {@inheritdoc}
     */
    public function afterCreate(\DotbBean $activity, \DotbBean $parent)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_AFTER_CREATE);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeCreate(\DotbBean $activity, \DotbBean $parent)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_BEFORE_CREATE);
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromStage(
        \DotbBean $activity,
        \DotbBean $parent,
        \DRI_SubWorkflow $stage,
        \DRI_Workflow_Task_Template $activityTemplate
    ) {
        $activity->dri_subworkflow_id = $stage->id;
        $activity->dri_subworkflow_name = $stage->name;

        if (empty($GLOBALS['current_user']->id)) {
            $activity->update_modified_by = false;
            $activity->set_created_by = false;
            $activity->created_by = $stage->created_by;
            $activity->modified_user_id = $stage->modified_user_id;
        }

        if ($activityTemplate->getAssigneeRule($stage) === \DRI_Workflow_Template::ASSIGNEE_RULE_CREATE) {
            $activity->assigned_user_id = $this->getTargetAssigneeId(
                $stage,
                $activityTemplate,
                $activity,
                $parent
            );
            $activity->team_id = $this->getTargetTeamId(
                $stage,
                $activityTemplate,
                $parent
            );
            $activity->team_set_id = $this->getTargetTeamSetId(
                $stage,
                $activityTemplate,
                $parent
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromJourneyTemplate(\DotbBean $activity, \DRI_Workflow_Template $journeyTemplate)
    {
        $activity->dri_workflow_template_id = $journeyTemplate->id;
        $activity->dri_workflow_template_name = $journeyTemplate->name;
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromStageTemplate(\DotbBean $activity, \DRI_SubWorkflow_Template $stageTemplate)
    {
        $activity->dri_subworkflow_template_id = $stageTemplate->id;
        $activity->dri_subworkflow_template_name = $stageTemplate->name;
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromParent(\DotbBean $activity, \DotbBean $parent)
    {
        $activity->parent_type = $parent->module_dir;
        $activity->parent_id = $parent->id;
        $activity->parent_name = $parent->name;
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromParentActivity(\DotbBean $activity, \DotbBean $parent)
    {
        $activity->cj_parent_activity_type = $parent->module_dir;
        $activity->cj_parent_activity_id = $parent->id;
    }

    /**
     * @param \DotbBean $activity
     * @param \DRI_Workflow_Task_Template $template
     * @return \DateTime|null
     * @throws \DRI_Workflows_Exception_IdNotFound
     * @throws \DRI_Workflows_Exception_ParentNotFound
     */
    protected function getDueDateFromParentField(\DotbBean $activity, \DRI_Workflow_Task_Template $template)
    {
        $timeDate = \TimeDate::getInstance();
        $stage = $this->getStage($activity);
        $parent = $stage->getParent($template->due_date_module);
        $def = $parent->getFieldDefinition($template->due_date_field);
        $value = $parent->{$template->due_date_field};

        if (!empty($value)) {
            if (in_array($def['type'], array ('datetime', 'datetimecombo'))) {
                $date = $timeDate->fromUser($value);

                if (!$date) {
                    $date = $timeDate->fromDb($value);
                }
            } else {
                $date = $timeDate->fromUserDate($value);

                if (!$date) {
                    $date = $timeDate->fromDbDate($value);
                }
            }

            return $date;
        }
    }

    /**
     * @param \DotbBean $activity
     * @param \DRI_Workflow_Task_Template $template
     * @return \DateTime|null
     */
    protected function getMomentumStartDateFromParentField(\DotbBean $activity, \DRI_Workflow_Task_Template $template)
    {
        $timeDate = \TimeDate::getInstance();
        $stage = $this->getStage($activity);

        try {
            $parent = $stage->getParent($template->momentum_start_module);
        } catch (\DRI_Workflows_Exception_NotFound $e) {
            return null;
        }

        $def = $parent->getFieldDefinition($template->momentum_start_field);
        $value = $parent->{$template->momentum_start_field};

        if (!empty($value)) {
            if (in_array($def['type'], array ('datetime', 'datetimecombo'))) {
                $date = $timeDate->fromUser($value);

                if (!$date) {
                    $date = $timeDate->fromDb($value);
                }
            } else {
                $date = $timeDate->fromUserDate($value);

                if (!$date) {
                    $date = $timeDate->fromDbDate($value);
                }
            }

            return $date;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMomentumPoints(\DotbBean $activity)
    {
        return (int)$activity->cj_momentum_points;
    }

    /**
     * {@inheritdoc}
     */
    public function getMomentumScore(\DotbBean $activity)
    {
        return (int)$activity->cj_momentum_score;
    }

    /**
     * {@inheritdoc}
     */
    public function start(\DotbBean $activity)
    {
        $stage = $this->getStage($activity);

        $save = false;

        if ($this->hasActivityTemplate($activity)) {
            $activityTemplate = $this->getActivityTemplate($activity);

            if ($activityTemplate->getAssigneeRule($stage) === \DRI_Workflow_Template::ASSIGNEE_RULE_STAGE_START) {
                $parent = $stage->getParent();

                if (empty($activity->assigned_user_id)) {
                    $activity->assigned_user_id = $this->getTargetAssigneeId(
                        $stage,
                        $activityTemplate,
                        $activity,
                        $parent
                    );
                }

                $activity->team_id = $this->getTargetTeamId(
                    $stage,
                    $activityTemplate,
                    $parent
                );
                $activity->team_set_id = $this->getTargetTeamSetId(
                    $stage,
                    $activityTemplate,
                    $parent
                );
                $save = true;
            }
        }

        if (!empty($activity->id)) {
            foreach ($this->getChildren($activity) as $child) {
                $handler = ActivityHandlerFactory::factory($child->module_dir);
                if ($handler->start($child)) {
                    $child->save();
                }
            }
        }

        return $save;
    }

    /**
     * {@inheritdoc}
     */
    public function afterCompleted(\DRI_Workflow $journey, \DRI_SubWorkflow $stage, \DotbBean $activity)
    {
        if ($this->hasParent($activity)) {
            $next = $this->getNextChildActivity($activity);
        } else {
            $next = $journey->getNextActivity($stage, $activity);
        }

        if ($next) {
            $handler = ActivityHandlerFactory::factory($next->module_dir);
            $handler->previousActivityCompleted($next, $activity);
        }

        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_AFTER_COMPLETED);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeCompleted(\DotbBean $activity)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_BEFORE_COMPLETED);
    }

    /**
     * {@inheritdoc}
     */
    public function afterInProgress(\DotbBean $activity)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_AFTER_IN_PROGRESS);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeInProgress(\DotbBean $activity)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_BEFORE_IN_PROGRESS);
    }

    /**
     * {@inheritdoc}
     */
    public function afterNotApplicable(\DotbBean $activity)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_AFTER_NOT_APPLICABLE);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeNotApplicable(\DotbBean $activity)
    {
        $this->sendWebHooks($activity, \CJ_WebHook::TRIGGER_EVENT_BEFORE_NOT_APPLICABLE);
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete(\DotbBean $activity)
    {
        // no op
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete(\DotbBean $activity)
    {
        // no op
    }

    /**
     * {@inheritdoc}
     */
    public function calculateMomentum(\DotbBean $activity)
    {
        $timeDate = \TimeDate::getInstance();

        if ($this->isStatusChanged($activity) &&
            $this->isCompleted($activity) &&
            empty($activity->cj_momentum_end_date)) {
            $activity->cj_momentum_end_date = $timeDate->asDb($timeDate->getNow());
        } else if (!$this->isCompleted($activity)) {
            $activity->cj_momentum_end_date = "";
        }

        $template = $this->getActivityTemplate($activity);
        $activity->cj_momentum_points = $template->momentum_points;

        if (!empty($activity->cj_momentum_start_date) && !empty($activity->cj_momentum_end_date)) {
            $startDate = $timeDate->fromDb($activity->cj_momentum_start_date);
            $endDate = $timeDate->fromDb($activity->cj_momentum_end_date);

            $diff = $startDate->diff($endDate);

            $actualHours = $diff->days * 24 + $diff->h + ($diff->i / 60);
            $dueDays = !empty($template->momentum_due_days) ? (int)$template->momentum_due_days : 0;
            $expectedHours = !empty($template->momentum_due_hours) ? (int)$template->momentum_due_hours : 0;
            $expectedHours += $dueDays * 24;

            if ($actualHours > 0) {
                $ratio = $expectedHours / $actualHours;
            } else {
                $ratio = $expectedHours === 0 && $actualHours !== 0 ? 0 : 1;
            }

            $activity->cj_momentum_ratio = $ratio >= 1 ? 1 : ($ratio < 0 ? 0 : $ratio);
            $activity->cj_momentum_score = round($template->momentum_points * $activity->cj_momentum_ratio);
        } else {
            $activity->cj_momentum_ratio = 1;
            $activity->cj_momentum_score = $template->momentum_points;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasMomentum(\DotbBean $activity)
    {
        if (!$this->hasActivityTemplate($activity)) {
            return false;
        }

        $template = $this->getActivityTemplate($activity);
        return !empty($template->momentum_start_type);
    }

    /**
     * {@inheritdoc}
     */
    public function getNextChildActivity(\DotbBean $activity)
    {
        $parent = $this->getParent($activity);
        $parentHandler = ActivityHandlerFactory::factory($parent->module_dir);

        foreach ($parentHandler->getChildren($parent) as $next) {
            $nextHandler = ActivityHandlerFactory::factory($next->module_dir);
            if (!$next->deleted && $nextHandler->getChildOrder($next) > $this->getChildOrder($activity)) {
                return $next;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function calculateStatus(\DotbBean $activity)
    {
        $children = $this->getChildren($activity);
        $count = count($children);
        $notStarted = 0;
        $completed = 0;

        foreach ($children as $child) {
            $handler = ActivityHandlerFactory::factory($child->module_dir);
            if ($handler->isNotStarted($child)) {
                $notStarted++;
            } elseif ($handler->isCompleted($child)) {
                $completed++;
            }
        }

        if ($completed === $count) {
            $this->setStatus($activity, $this->getCompletedStatus());
        } elseif ($notStarted === $count) {
            $this->setStatus($activity, $this->getNotStartedStatus());
        } else {
            $this->setStatus($activity, $this->getInProgressStatus());
        }

        return $this->isStatusChanged($activity);
    }

    /**
     * @param \DotbBean $activity
     * @param string $status
     */
    public function setStatus(\DotbBean $activity, $status)
    {
        $activity->status = $status;
    }

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isStatusChanged(\DotbBean $activity)
    {
        return $this->isFieldChanged($activity, 'status');
    }

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isPointsChanged(\DotbBean $activity)
    {
        return $this->isFieldChanged($activity, 'customer_journey_points');
    }

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isScoreChanged(\DotbBean $activity)
    {
        return $this->isFieldChanged($activity, 'customer_journey_score');
    }

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isProgressChanged(\DotbBean $activity)
    {
        return $this->isFieldChanged($activity, 'customer_journey_progress');
    }

    /**
     * @param \DotbBean $activity
     * @param string $field
     * @return bool
     */
    protected function isFieldChanged(\DotbBean $activity, $field)
    {
        return $activity->{$field} !== $activity->fetched_row[$field];
    }

    /**
     * {@inheritdoc}
     */
    public function createFromTemplate(
        \DRI_Workflow_Task_Template $activityTemplate,
        \DRI_SubWorkflow $stage,
        \DotbBean $parent
    ) {
        $activity = $this->create();

        $this->populateFromStage($activity, $parent, $stage, $activityTemplate);
        $this->populateFromStageTemplate($activity, $stage->getTemplate());
        $this->populateFromJourneyTemplate($activity, $stage->getTemplate()->getJourneyTemplate());
        $this->populateFromParent($activity, $parent);
        $this->populateFromTemplate($activity, $activityTemplate);

        return $activity;
    }

    /**
     * @param \DRI_SubWorkflow $stage
     * @param \DRI_Workflow_Task_Template $activityTemplate
     * @param \DotbBean $activity
     * @param \DotbBean $parent
     * @return string
     * @throws \DRI_Workflows_Exception_IdNotFound
     */
    public function getTargetAssigneeId(
        \DRI_SubWorkflow $stage,
        \DRI_Workflow_Task_Template $activityTemplate,
        \DotbBean $activity,
        \DotbBean $parent
    ) {
        switch ($activityTemplate->target_assignee) {
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_CURRENT_USER:
                if (!empty($GLOBALS['current_user']->id)) {
                    return $GLOBALS['current_user']->id;
                } else {
                    return $activity->created_by;
                }

            case \DRI_Workflow_Template::TARGET_ASSIGNEE_PARENT:
                return $parent->assigned_user_id;
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_USER:
                return $activityTemplate->target_assignee_user_id;
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_TEAM:
                return "";
        }

        return $stage->getTargetAssigneeId();
    }

    /**
     * @param \DRI_SubWorkflow $stage
     * @param \DRI_Workflow_Task_Template $activityTemplate
     * @param \DotbBean $parent
     * @return string
     * @throws \DRI_Workflows_Exception_IdNotFound
     */
    public function getTargetTeamId(
        \DRI_SubWorkflow $stage,
        \DRI_Workflow_Task_Template $activityTemplate,
        \DotbBean $parent
    ) {
        switch ($activityTemplate->target_assignee) {
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_CURRENT_USER:
                return !empty($GLOBALS['current_user']->id) ? $GLOBALS['current_user']->default_team : '1';
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_PARENT:
                return $parent->team_id;
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_USER:
                return \BeanFactory::getBean("Users", $activityTemplate->target_assignee_user_id)->team_id;
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_TEAM:
                return $activityTemplate->target_assignee_team_id;
        }

        return $stage->getTargetTeamId();
    }

    /**
     * @param \DRI_SubWorkflow $stage
     * @param \DRI_Workflow_Task_Template $activityTemplate
     * @param \DotbBean $parent
     * @return string
     * @throws \DRI_Workflows_Exception_IdNotFound
     */
    public function getTargetTeamSetId(
        \DRI_SubWorkflow $stage,
        \DRI_Workflow_Task_Template $activityTemplate,
        \DotbBean $parent
    ) {
        switch ($activityTemplate->target_assignee) {
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_CURRENT_USER:
                return !empty($GLOBALS['current_user']->id) ? $GLOBALS['current_user']->team_set_id : '1';
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_PARENT:
                return $parent->team_set_id;
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_USER:
                $userTeamSetId = \BeanFactory::getBean(
                    "Users",
                    $activityTemplate->target_assignee_user_id
                )->team_set_id;
                $stageTeamSetId = $stage->getTargetTeamSetId();

                $teamSet = new \TeamSet();
                $teamSetIds = $teamSet->getTeamIds($stageTeamSetId);

                if (!empty($userTeamSetId)) {
                    $teamSetIds = array_merge($teamSetIds, $teamSet->getTeamIds($userTeamSetId));
                }

                return $teamSet->addTeams($teamSetIds);
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_TEAM:
                $teamSet = new \TeamSet();
                $teamSetIds = array_merge(
                    $teamSet->getTeamIds($stage->getTargetTeamSetId()),
                    array ($activityTemplate->target_assignee_team_id)
                );

                return $teamSet->addTeams($teamSetIds);
        }

        return $stage->getTargetTeamSetId();
    }

    /**
     * {@inheritdoc}
     */
    public function relateToParent(\DotbBean $activity, \DotbBean $parent)
    {
        $linkName = $this->getLinkName();
        $this->loadRelationship($parent, $linkName);
        $parent->{$linkName}->add($activity);
    }

    /**
     * {@inheritdoc}
     */
    public function getByStageIdAndName($stageId, $name, $skipId)
    {
        $query = new \DotbQuery();
        $query->from($this->create());
        $query->select('id');
        $where = $query->where();
        $where->equals('dri_subworkflow_id', $stageId);
        $where->equals('name', $name);

        if (null !== $skipId) {
            $where->notEquals('id', $skipId);
        }

        $results = $query->execute();

        if (count($results) === 0) {
            throw new \DotbApiExceptionNotFound();
        }

        $result = array_shift($results);

        return $this->getById($result['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getByStageIdAndOrder($stageId, $order, $skipId)
    {
        $query = new \DotbQuery();
        $query->from($this->create());
        $query->select('id');
        $where = $query->where();
        $where->equals('dri_subworkflow_id', $stageId);
        $where->equals('dri_workflow_sort_order', $order);

        if (null !== $skipId) {
            $where->notEquals('id', $skipId);
        }

        $results = $query->execute();

        if (count($results) === 0) {
            throw new \DotbApiExceptionNotFound();
        }

        $result = array_shift($results);

        return $this->getById($result['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildOrder(\DotbBean $activity)
    {
        $order = $this->getSortOrder($activity);

        if (false !== strpos($order, '.')) {
            list($_, $order) = explode('.', $order);
        }

        return (int) $order;
    }

    /**
     * {@inheritdoc}
     */
    public function getSortOrder(\DotbBean $activity)
    {
        return (string) $activity->dri_workflow_sort_order;
    }

    /**
     * {@inheritdoc}
     */
    public function getPoints(\DotbBean $activity)
    {
        return (int)$activity->customer_journey_points;
    }

    /**
     * before_save logic hook
     *
     * @param \DotbBean $activity
     */
    public function calculate(\DotbBean $activity)
    {
        $this->setPoints($activity, $this->calculatePoints($activity));
        $this->setScore($activity, $this->calculateScore($activity));
        $this->setProgress($activity, $this->calculateProgress($activity));
    }

    /**
     * {@inheritdoc}
     */
    public function calculatePoints(\DotbBean $activity)
    {
        $points = 0;

        if ($this->isParent($activity)) {
            foreach ($this->getChildren($activity) as $child) {
                $handler = ActivityHandlerFactory::factory($child->module_dir);
                $points += $handler->getPoints($child);
            }
        }

        if (0 === $points) {
            if (!empty($activity->customer_journey_points)) {
                $points = (int)$activity->customer_journey_points;
            } elseif ($this->hasActivityTemplate($activity)) {
                $template = $this->getActivityTemplate($activity);

                if (!empty($template->points)) {
                    $points = (int)$template->points;
                }
            }
        }

        return $points;
    }

    /**
     * {@inheritdoc}
     */
    public function setPoints(\DotbBean $activity, $points)
    {
        $activity->customer_journey_points = $points;
    }

    /**
     * {@inheritdoc}
     */
    public function getScore(\DotbBean $activity)
    {
        return (int)$activity->customer_journey_score;
    }

    /**
     * {@inheritdoc}
     */
    public function setScore(\DotbBean $activity, $score)
    {
        $activity->customer_journey_score = $score;
    }

    /**
     * @param \DotbBean $activity
     * @param $trigger_event
     * @throws \DRI_Workflows_Exception_IdNotFound
     * @throws \DotbApiException
     * @throws \DotbQueryException
     */
    public function sendWebHooks(\DotbBean $activity, $trigger_event)
    {
        if (!$this->hasActivityTemplate($activity)) {
            return;
        }

        $template = $this->getActivityTemplate($activity);
        $stage = $this->getStage($activity);
        $parent = $stage->getParent();
        $journey = $stage->getJourney();

        $template->sendWebHooks($trigger_event, array (
            'parent_module' => $parent->module_dir,
            'parent' => $parent->toArray(true),
            'journey' => $journey->toArray(true),
            'stage' => $stage->toArray(true),
            'activity' => $activity->toArray(true),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function calculateScore(\DotbBean $activity)
    {
        $score = 0;

        if ($this->isParent($activity)) {
            foreach ($this->getChildren($activity) as $child) {
                $handler = ActivityHandlerFactory::factory($child->module_dir);
                $score += $handler->getScore($child);
            }
        } elseif ($this->isCompleted($activity)) {
            $score = $this->getPoints($activity);
        } elseif ($this->isInProgress($activity)) {
            $score = $this->getPoints($activity) * 0.3;
        }

        return $score;
    }

    /**
     * {@inheritdoc}
     */
    public function setProgress(\DotbBean $activity, $progress)
    {
        $activity->customer_journey_progress = $progress;
    }

    /**
     * {@inheritdoc}
     */
    public function getProgress(\DotbBean $activity)
    {
        return $activity->customer_journey_progress;
    }

    /**
     * {@inheritdoc}
     */
    public function calculateProgress(\DotbBean $activity)
    {
        $points = $this->getPoints($activity);
        $score = $this->getScore($activity);
        return $points > 0 ? round($score / $points, 2) : 0;
    }

    /**
     * {@inheritdoc}
     */
    public function increaseSortOrder(\DotbBean $activity)
    {
        $activity->dri_workflow_sort_order++;
        $this->setActualSortOrder($activity);
    }

    /**
     * @var \DRI_SubWorkflow
     */
    private $stageCache;

    /**
     * @param \DRI_SubWorkflow $stage
     */
    public function setStage(\DRI_SubWorkflow $stage)
    {
        $this->stageCache = $stage;
    }

    /**
     * {@inheritdoc}
     */
    public function getStage(\DotbBean $activity)
    {
        if (null === $this->stageCache) {
            $this->stageCache = \DRI_SubWorkflow::getById($this->getStageId($activity));
        }

        return $this->stageCache;
    }

    /**
     * @param \DotbBean $activity
     * @return \DRI_SubWorkflow
     */
    public function setActualSortOrder(\DotbBean $activity)
    {
        $stage = $this->getStage($activity);
        $activitySortOrder = "{$activity->dri_workflow_sort_order}";
        $stageSortOrder = "{$stage->sort_order}";

        if (strlen($activitySortOrder) === 1) {
            $activitySortOrder = "0{$activitySortOrder}";
        }

        if (strlen($stageSortOrder) === 1) {
            $stageSortOrder = "0{$stageSortOrder}";
        }

        $activity->cj_actual_sort_order = "{$stageSortOrder}.{$activitySortOrder}";
    }

    /**
     * {@inheritdoc}
     */
    public function hasActivityTemplate(\DotbBean $activity)
    {
        $id = $this->getActivityTemplateId($activity);
        return !empty($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getActivityTemplate(\DotbBean $activity)
    {
        return \DRI_Workflow_Task_Template::getById($this->getActivityTemplateId($activity));
    }

    /**
     * {@inheritdoc}
     */
    public function getStageId(\DotbBean $activity)
    {
        if (!empty($activity->dri_subworkflow_id)) {
            return $activity->dri_subworkflow_id;
        }

        if ($activity->deleted && !empty($activity->fetched_row['dri_subworkflow_id'])) {
            return $activity->fetched_row['dri_subworkflow_id'];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getStageIdFieldName()
    {
        return 'dri_subworkflow_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getActivityTemplateId(\DotbBean $activity)
    {
        if (!empty($activity->dri_workflow_task_template_id)) {
            return $activity->dri_workflow_task_template_id;
        }

        if ($activity->deleted && !empty($activity->fetched_row['dri_workflow_task_template_id'])) {
            return $activity->fetched_row['dri_workflow_task_template_id'];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function orderExistOnStage($stageId, $order, $skipId)
    {
        $query = new \DotbQuery();
        $query->from($this->create());
        $query->select('id');
        $where = $query->where();
        $where->equals('dri_workflow_sort_order', $order);
        $where->equals('dri_subworkflow_id', $stageId);

        if (!empty($skipId)) {
            $where->notEquals('id', $skipId);
        }

        $results = $query->execute();

        return count($results) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function isStageActivity(\DotbBean $activity)
    {
        return !empty($activity->dri_subworkflow_id)
            || ($activity->deleted && !empty($activity->fetched_row['dri_subworkflow_id']));
    }

    /**
     * Retrieves a activity by id
     *
     * @param string $id
     * @return \DotbBean
     * @throws \DotbApiExceptionNotFound
     */
    protected function getById($id)
    {
        if (empty($id)) {
            throw new \DotbApiExceptionNotFound();
        }

        $activity = \BeanFactory::retrieveBean($this->create()->module_dir, $id);

        if (null === $activity) {
            throw new \DotbApiExceptionNotFound();
        }

        return $activity;
    }

    /**
     * {@inheritdoc}
     */
    public function haveChangedStatus(\DotbBean $activity)
    {
        return $activity->fetched_row_before['status'] !== $activity->status;
    }

    /**
     * {@inheritdoc}
     */
    public function haveChangedPoints(\DotbBean $activity)
    {
        return $activity->fetched_row_before['customer_journey_points'] !== $activity->customer_journey_points;
    }

    /**
     * {@inheritdoc}
     */
    public function isBlocked(\DotbBean $activity)
    {
        if (!$this->hasBlockedBy($activity)) {
            return false;
        }

        $blockedBy = $this->getBlockedBy($activity);

        return !empty($blockedBy);
    }

    /**
     * {@inheritdoc}
     */
    public function isParent(\DotbBean $activity)
    {
        return !empty($activity->is_cj_parent_activity);
    }

    /**
     * {@inheritdoc}
     */
    public function hasParent(\DotbBean $activity)
    {
        return !empty($activity->cj_parent_activity_id);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(\DotbBean $activity)
    {
        return $this->hasParent($activity) ? \BeanFactory::retrieveBean(
            $activity->cj_parent_activity_type,
            $activity->cj_parent_activity_id
        ) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockedByIds(\DotbBean $activity)
    {
        if (empty($activity->customer_journey_blocked_by)) {
            return array ();
        }

        return is_string($activity->customer_journey_blocked_by)
            ? json_decode($activity->customer_journey_blocked_by, true)
            : (is_array($activity->customer_journey_blocked_by) ? $activity->customer_journey_blocked_by : array ());
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockedByActivityIds(\DotbBean $activity)
    {
        $ids = array ();

        foreach ($this->getBlockedBy($activity) as $bean) {
            $ids[] = $bean->id;
        }

        return $ids;
    }

    /**
     * {@inheritdoc}
     */
    public function hasBlockedBy(\DotbBean $activity)
    {
        return count($this->getBlockedByIds($activity)) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockedBy(\DotbBean $activity)
    {
        if (!$this->hasBlockedBy($activity)) {
            return array ();
        }

        $stage = $this->getStage($activity);
        $journey = $stage->getJourney();

        $blockedBy = array ();
        foreach ($this->getBlockedByIds($activity) as $id) {
            $bean = $journey->getActivityByTemplateId($id);

            if ($bean) {
                $handler = ActivityHandlerFactory::factory($bean->module_dir);

                if (!$handler->isCompleted($bean)) {
                    $blockedBy[] = $bean;
                }
            }
        }

        return $blockedBy;
    }

    /**
     * @param \DotbBean $bean
     * @param string $linkName
     * @throws \DotbApiExceptionError
     */
    protected function loadRelationship(\DotbBean $bean, $linkName)
    {
        $bean->load_relationship($linkName);

        if (!($bean->{$linkName} instanceof \Link2)) {
            throw new \DotbApiExceptionError(sprintf('unable to load link: %s', $linkName));
        }
    }

    /**
     * @return string
     */
    protected function getLinkName()
    {
        return $this->linkName;
    }

    /**
     * {@inheritdoc}
     */
    public function load(\DRI_SubWorkflow $stage)
    {
        // really make sure not to load this relationship if the stage is new.
        // If doing this and the id is empty ALL activities in the system not related to a CJ
        // will be retrieved and potentially changed!
        if (empty($stage->id)) {
            return array ();
        }

        $bean = \BeanFactory::newBean($this->moduleName);

        $query = $this->createLoadQuery();
        $query->where()
            ->equals('dri_subworkflow_id', $stage->id);

        return $bean->fetchFromQuery($query);
    }

    /**
     * @return \DotbQuery
     */
    public function createLoadQuery()
    {
        $bean = \BeanFactory::newBean($this->moduleName);

        $query = new \DotbQuery();
        $query->from($bean);
        $query->select('*');
        $query->where()
            ->isEmpty('cj_parent_activity_id');

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveChildren(\DotbBean $bean)
    {
        $query = new \DotbQuery();
        $query->from(\BeanFactory::newBean($this->moduleName));
        $query->select('id');
        $query->where()
            ->equals('cj_parent_activity_id', $bean->id)
            ->equals('cj_parent_activity_type', $bean->module_dir);

        $activities = array ();

        $results = $query->execute();

        foreach ($results as $result) {
            $activities[] = \BeanFactory::retrieveBean($this->moduleName, $result['id']);
        }

        return $activities;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren(\DotbBean $bean)
    {
        $this->loadChildren($bean);

        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function getForms(\DotbBean $bean)
    {
        return $this->getActivityTemplate($bean)->getForms();
    }

    /**
     * {@inheritdoc}
     */
    public function loadChildren(\DotbBean $bean)
    {
        if (null === $this->children) {
            $this->children = array ();

            foreach (ActivityHandlerFactory::all() as $activityHandler) {
                $this->children = array_merge($this->children, $activityHandler->retrieveChildren($bean));
            }

            $this->children = $this->sortChildren($this->children);
        }
    }

    /**
     * @param \DotbBean $activity
     * @param \DotbBean $child
     */
    public function insertChild(\DotbBean $activity, \DotbBean $child)
    {
        foreach ($this->getChildren($activity) as $id => $bean) {
            if ($bean->id === $child->id) {
                $this->children[$id] = $child;
            }
        }
    }

    /**
     * Since all php functions that sorts an array based on a function is blacklisted by the package scanner
     * we have to implement our own algorithm, this is based on quicksort
     *
     * @param \DotbBean[] $activities
     * @return array
     */
    private function sortChildren($activities) {
        if (count($activities) < 2) {
            return $activities;
        }

        $left = $right = array ();
        reset($activities);
        $pivot_key = key($activities);
        $pivotActivity = array_shift($activities);
        $pivot = ActivityHandlerFactory::factory($pivotActivity->module_dir)->getChildOrder($pivotActivity);

        foreach ($activities as $k => $activity) {
            $order = ActivityHandlerFactory::factory($activity->module_dir)->getChildOrder($activity);
            if ($order < $pivot) {
                $left[$k] = $activity;
            } else {
                $right[$k] = $activity;
            }
        }

        return array_merge(
            $this->sortChildren($left),
            array($pivot_key => $pivotActivity),
            $this->sortChildren($right)
        );
    }
}
