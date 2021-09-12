<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Top implementation of the Task Activity Handler
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class TaskHandler extends AbstractActivityHandler
{
    const STATUS_NOT_STARTED = 'Not Started';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_NOT_APPLICABLE = 'Not Applicable';

    /**
     * @var string
     */
    protected $linkName = 'tasks';

    /**
     * @var string
     */
    protected $moduleName = 'Tasks';

    /**
     * {@inheritdoc}
     */
    public function isCompleted(\DotbBean $activity)
    {
        return isset($GLOBALS['app_list_strings']['cj_tasks_completed_status_list'][$activity->status]);
    }

    /**
     * {@inheritdoc}
     */
    public function isInProgress(\DotbBean $activity)
    {
        return $activity->status === self::STATUS_IN_PROGRESS;
    }

    /**
     * {@inheritdoc}
     */
    public function isNotStarted(\DotbBean $activity)
    {
        return $activity->status === self::STATUS_NOT_STARTED;
    }

    /**
     * {@inheritdoc}
     */
    public function isNotApplicable(\DotbBean $activity)
    {
        return $activity->status === self::STATUS_NOT_APPLICABLE;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotStartedStatus()
    {
        return static::STATUS_NOT_STARTED;
    }

    /**
     * {@inheritdoc}
     */
    public function getInProgressStatus()
    {
        return static::STATUS_IN_PROGRESS;
    }

    /**
     * {@inheritdoc}
     */
    public function getCompletedStatus()
    {
        return static::STATUS_COMPLETED;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotApplicableStatus()
    {
        return static::STATUS_NOT_APPLICABLE;
    }

    /**
     * {@inheritdoc}
     */
    public function start(\DotbBean $activity)
    {
        $timeDate = \TimeDate::getInstance();

        $save = parent::start($activity);

        if ($this->hasActivityTemplate($activity)) {
            $template = $this->getActivityTemplate($activity);

            switch ($template->task_due_date_type) {
                case \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_STAGE_STARTED:
                    if (empty($activity->date_due)) {
                        $activity->date_due = $this->getDueDate($template, $timeDate->getNow());
                        $save = true;
                    }
                    break;
            }

            switch ($template->momentum_start_type) {
                case \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_STAGE_STARTED:
                    $activity->cj_momentum_start_date = $timeDate->asUser($timeDate->getNow());
                    break;
            }
        }

        return $save;
    }

    /**
     * {@inheritdoc}
     */
    public function previousActivityCompleted(\DotbBean $activity, \DotbBean $previous)
    {
        $timeDate = \TimeDate::getInstance();

        if ($this->hasActivityTemplate($activity)) {
            $template = $this->getActivityTemplate($activity);
            $stage = $this->getStage($activity);

            if ($template->task_due_date_type === \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_PREVIOUS_ACTIVITY_COMPLETED
                    && empty($activity->date_due)) {
                $activity->date_due = $this->getDueDate($template, $timeDate->getNow());
                $activity->save();
            }

            if ($template->momentum_start_type === \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_PREVIOUS_ACTIVITY_COMPLETED) {
                $activity->cj_momentum_start_date = $timeDate->asUser($timeDate->getNow());
                $activity->save();
            }

            if ($template->getAssigneeRule($stage) === \DRI_Workflow_Task_Template::ASSIGNEE_RULE_PREVIOUS_ACTIVITY_COMPLETED
                && empty($activity->assigned_user_id)) {
                $parent = $stage->getParent();

                if (empty($activity->assigned_user_id)) {
                    $activity->assigned_user_id = $this->getTargetAssigneeId($stage, $template, $activity, $parent);
                }

                $activity->team_id = $this->getTargetTeamId($stage, $template, $parent);
                $activity->team_set_id = $this->getTargetTeamSetId($stage, $template, $parent);
                $activity->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new \Task();
    }

    /**
     * {@inheritdoc}
     */
    public function populateFromTemplate(\DotbBean $activity, \DRI_Workflow_Task_Template $template)
    {
        $timeDate = \TimeDate::getInstance();

        /** @var \Task $activity */
        parent::populateFromTemplate($activity, $template);

        $activity->priority = $template->priority;
        $activity->customer_journey_type = $template->type;
        $activity->status = self::STATUS_NOT_STARTED;

        $dateCreated = $timeDate->getNow();
        $activity->date_start = $timeDate->asUser($dateCreated);

        switch ($template->task_due_date_type) {
            case \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_CREATED:
                $activity->date_due = $this->getDueDate($template, $dateCreated);
                break;
            case \DRI_Workflow_Task_Template::TASK_DUE_DATE_TYPE_DAYS_FROM_PARENT_DATE_FIELD:
                $this->setDueDateFromParentField($activity);
                break;
        }

        switch ($template->momentum_start_type) {
            case \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_CREATED:
                $activity->cj_momentum_start_date = $timeDate->asUser($timeDate->getNow());
                break;
            case \DRI_Workflow_Task_Template::MOMENTUM_START_TYPE_PARENT_DATE_FIELD:
                $this->setMomentumStartDateFromParentField($activity);
                break;
        }
    }

    /**
     * @param \DotbBean $activity
     */
    public function setDueDateFromParentField(\DotbBean $activity)
    {
        if (!$this->hasActivityTemplate($activity)) {
            return;
        }

        $template = $this->getActivityTemplate($activity);
        $date = $this->getDueDateFromParentField($activity, $template);

        if (!empty($date)) {
            $activity->date_due = $this->getDueDate($template, $date);
        }
    }

    /**
     * @param \DRI_Workflow_Task_Template $template
     * @param \DateTime $date
     * @return string
     */
    private function getDueDate(\DRI_Workflow_Task_Template $template, \DateTime $date)
    {
        $timeDate = \TimeDate::getInstance();
        $dueDate = clone $date;

        if ($template->task_due_days > 0) {
            $dueDate->modify(sprintf(
                '+ %s days',
                $template->task_due_days
            ));
        } else {
            $dueDate->modify(sprintf(
                '- %s days',
                -$template->task_due_days
            ));
        }

        return $timeDate->asUser($dueDate);
    }

    /**
     * @param \DotbBean $activity
     * @throws \DRI_Workflows_Exception_IdNotFound
     * @throws \DRI_Workflows_Exception_ParentNotFound
     */
    public function setMomentumStartDateFromParentField(\DotbBean $activity)
    {
        if (!$this->hasActivityTemplate($activity)) {
            return;
        }

        $timeDate = \TimeDate::getInstance();
        $template = $this->getActivityTemplate($activity);
        $date = $this->getMomentumStartDateFromParentField($activity, $template);

        if (!empty($date)) {
            $activity->cj_momentum_start_date = $timeDate->asUser($date);
        }
    }
}
