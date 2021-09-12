<?php

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflow_Task_Template extends Basic
{
    const TASK_DUE_DATE_TYPE_DAYS_FROM_CREATED = 'days_from_created';
    const TASK_DUE_DATE_TYPE_DAYS_FROM_STAGE_STARTED = 'days_from_stage_started';
    const TASK_DUE_DATE_TYPE_DAYS_FROM_PREVIOUS_ACTIVITY_COMPLETED = 'days_from_previous_activity_completed';
    const TASK_DUE_DATE_TYPE_DAYS_FROM_PARENT_DATE_FIELD = 'days_from_parent_date_field';

    const SEND_INVITES_NONE = 'none';
    const SEND_INVITES_CREATE = 'create';
    const SEND_INVITES_STAGE_START = 'stage_start';

    const MOMENTUM_START_TYPE_CREATED = 'created';
    const MOMENTUM_START_TYPE_STAGE_STARTED = 'stage_started';
    const MOMENTUM_START_TYPE_PREVIOUS_ACTIVITY_COMPLETED = 'previous_activity_completed';
    const MOMENTUM_START_TYPE_PARENT_DATE_FIELD = 'parent_date_field';

    const ASSIGNEE_RULE_INHERIT = "inherit";
    const ASSIGNEE_RULE_NONE = "none";
    const ASSIGNEE_RULE_CREATE = "create";
    const ASSIGNEE_RULE_STAGE_START = "stage_start";
    const ASSIGNEE_RULE_PREVIOUS_ACTIVITY_COMPLETED = "previous_activity_completed";

    /**
     * Retrieves a DRI_Workflow_Task_Template with id $id and
     * returns a instance of the retrieved bean
     *
     * @param string $id: the id of the DRI_Workflow_Task_Template that should be retrieved
     * @return DRI_Workflow_Task_Template
     * @throws DRI_Workflow_Task_Templates_Exception_IdNotFound: if not found
     */
    public static function getById($id)
    {
        if (empty($id)) {
            require_once 'modules/DRI_Workflow_Task_Templates/Exception/IdNotFound.php';
            throw new DRI_Workflow_Task_Templates_Exception_IdNotFound($id);
        }

        /** @var DRI_Workflow_Task_Template $bean */
        $bean = BeanFactory::retrieveBean('DRI_Workflow_Task_Templates', $id, array (
            'disable_row_level_security' => true,
        ));

        if (null === $bean) {
            require_once 'modules/DRI_Workflow_Task_Templates/Exception/IdNotFound.php';
            throw new DRI_Workflow_Task_Templates_Exception_IdNotFound($id);
        }

        return $bean;
    }

    /**
     * Retrieves a DRI_Workflow_Task_Template with name $name and
     * returns a instance of the retrieved bean
     *
     * @param string $name : the name of the DRI_Workflow_Task_Template that should be retrieved
     * @param string $parentId
     * @param string|null $skipId
     * @return DRI_Workflow_Task_Template
     * @throws DRI_Workflow_Task_Templates_Exception_NameNotFound
     * @throws DRI_Workflow_Task_Templates_Exception_IdNotFound
     */
    public static function getByNameAndParent($name, $parentId, $skipId = null)
    {
        $db = DBManagerFactory::getInstance();

        $sql = <<<SQL
            SELECT id
            FROM dri_workflow_task_templates
            WHERE name = '%s' AND
                deleted = 0
              AND dri_subworkflow_template_id = '%s'
SQL;

        if (!empty($skipId)) {
            $sql .= " AND id != '$skipId'";
        }

        $sql = sprintf($sql, $db->quote($name), $parentId);
        $id = $db->getOne($sql);

        if (empty($id)) {
            require_once 'modules/DRI_Workflow_Task_Templates/Exception/NameNotFound.php';
            throw new DRI_Workflow_Task_Templates_Exception_NameNotFound($name);
        }

        return self::getById($id);
    }

    /**
     * Retrieves a DRI_Workflow_Task_Template with name $name and
     * returns a instance of the retrieved bean
     *
     * @param string $sortOrder : the name of the DRI_Workflow_Task_Template that should be retrieved
     * @param string $parentId
     * @param string|null $skipId
     * @return DRI_Workflow_Task_Template
     * @throws DRI_Workflow_Task_Templates_Exception_NameNotFound
     * @throws DRI_Workflow_Task_Templates_Exception_IdNotFound
     */
    public static function getByOrderAndParent($sortOrder, $parentId, $skipId = null)
    {
        $db = DBManagerFactory::getInstance();

        $sql = <<<SQL
            SELECT id
            FROM dri_workflow_task_templates
            WHERE sort_order = '%s' AND
                deleted = 0
              AND dri_subworkflow_template_id = '%s'
SQL;

        if (!empty($skipId)) {
            $sql .= " AND id != '$skipId'";
        }

        $sql = sprintf($sql, $sortOrder, $parentId);
        $id = $db->getOne($sql);

        if (empty($id)) {
            require_once 'modules/DRI_Workflow_Task_Templates/Exception/NameNotFound.php';
            throw new DRI_Workflow_Task_Templates_Exception_NameNotFound($sortOrder);
        }

        return self::getById($id);
    }

    public $disable_row_level_security = false;
    public $new_schema = true;
    public $module_dir = 'DRI_Workflow_Task_Templates';
    public $object_name = 'DRI_Workflow_Task_Template';
    public $table_name = 'dri_workflow_task_templates';
    public $importable = true;

    public $team_id;
    public $team_set_id;
    public $team_count;
    public $team_name;
    public $team_link;
    public $team_count_link;
    public $teams;
    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $task_due_date_type;
    public $task_due_days;
    public $sort_order;
    public $tasks;
    public $dri_subworkflow_template_id;
    public $dri_subworkflow_template_name;
    public $dri_subworkflow_template_link;
    public $priority;
    public $type;
    public $activity_type;
    public $time_of_day;
    public $duration_hours;
    public $duration_minutes;
    public $direction;
    public $points;
    public $dri_workflow_template_id;
    public $dri_workflow_template_name;
    public $dri_workflow_template_link;

    /**
     * @var array
     */
    public $blocked_by;
    public $blocked_by_id;
    public $blocked_by_name;
    public $blocked_by_link;
    public $activities;
    public $following;
    public $following_link;
    public $favorite_link;
    public $tag;
    public $tag_link;
    public $duration;
    public $calls;
    public $meetings;
    public $locked_fields;
    public $locked_fields_link;
    public $acl_team_set_id;
    public $acl_team_names;
    public $send_invites;
    public $children;
    public $is_parent;
    public $parent_id;
    public $parent_name;
    public $parent_link;
    public $target_assignee;
    public $target_assignee_user_id;
    public $target_assignee_user_name;
    public $target_assignee_user_link;
    public $target_assignee_team_id;
    public $target_assignee_team_name;
    public $target_assignee_team_link;
    public $stage_template_label;
    public $stage_template_sort_order;
    public $due_date_module;
    public $due_date_field;
    public $momentum_start_type;
    public $momentum_start_module;
    public $momentum_start_field;
    public $momentum_points;
    public $momentum_due_days;
    public $momentum_due_hours;
    public $assignee_rule;
    public $url;

    /**
     * @var Link2
     */
    public $forms;
    public $web_hooks;

    /**
     * @param string $interface
     * @return boolean
     */
    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }

        return false;
    }

    /**
     * @param string $id
     * @param bool $encode
     * @param bool $deleted
     * @return Basic
     */
    public function retrieve($id = '-1', $encode = true, $deleted = true)
    {
        $return = parent::retrieve($id, $encode, $deleted);

        // migrate blocked by field
        if (!empty($this->blocked_by_id) && empty($this->blocked_by)) {
            $this->blocked_by = json_encode(array ($this->blocked_by_id));
        }

        // empty old blocked by fields
        $this->blocked_by_id = '';
        $this->blocked_by_name = '';

        return $return;
    }

    /**
     * @param bool $check_notify
     * @return string
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    public function save($check_notify = false)
    {
        $this->validateUniqueName();

        $this->duration_hours = !empty($this->duration_hours) ? $this->duration_hours : 0;

        $this->setJourneyTemplate();

        $this->is_parent = $this->isParent();
        $prevStageTemplate = null;
        $parent = null;

        if ($this->hasParent()) {
            $parent = $this->getParent();
        }

        $this->calculatePoints();

        if (!empty($this->fetched_row) && $this->fetched_row['dri_subworkflow_template_id'] != $this->dri_subworkflow_template_id) {
            $prevStageTemplate = $this->getPreviousStageTemplate();
        }

        $this->setSortOrder();

        $return = parent::save($check_notify);

        if ($this->hasStageTemplate()) {
            $this->getStageTemplate()->save();
        }

        if (null !== $parent) {
            $parent->save();
        }

        if (null !== $prevStageTemplate) {
            $prevStageTemplate->retrieve();
            $prevStageTemplate->save();
        }

        $this->clearParentActivityDatesCache();

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function getForms()
    {
        $journeyTemplate = $this->getJourneyTemplate();
        $journeyTemplate->load_relationship('forms');

        $forms = $journeyTemplate->forms->getBeans();
        $filtered = array ();

        foreach ($forms as $form) {
            if ($form->active && $form->activity_template_id === $this->id) {
                $filtered[] = $form;
            }
        }

        return $filtered;
    }

    public function getAssigneeRule(DRI_SubWorkflow $stage) {
        if ($this->assignee_rule === self::ASSIGNEE_RULE_INHERIT) {
            return $stage->getAssigneeRule();
        }

        return $this->assignee_rule;
    }

    /**
     * @throws DotbQueryException
     */
    private function calculatePoints()
    {
        if ($this->is_parent) {
            $this->points = 0;
            foreach ($this->getChildren() as $child) {
                $this->points += $child->points;
            }
        }
    }

    /**
     * @param $trigger_event
     * @param array $request
     * @throws DotbApiException
     * @throws DotbQueryException
     */
    public function sendWebHooks($trigger_event, array $request)
    {
        \CJ_WebHook::send($this, $trigger_event, $request);
    }

    /**
     * @param $id
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    public function mark_deleted($id)
    {
        if ($this->id != $id) {
            $this->retrieve($id);
        }

        $childTemplates = $this->getChildren();

        $parent = null;

        if ($this->hasParent()) {
            $parent = $this->getParent();
        }

        try {
            $stage = $this->getStageTemplate();
        } catch (\Exception $e) {
            $stage = null;
        }

        CJ_WebHook::deleteWebHooks($this);
        $this->deleteForms();

        parent::mark_deleted($id);

        foreach ($childTemplates as $childTemplate) {
            $childTemplate->mark_deleted($childTemplate->id);
        }

        if (null !== $parent && !$parent->deleted) {
            $parent->save();
        }

        if (null !== $stage && !$stage->deleted) {
            $stage->save();
        }

        $this->clearParentActivityDatesCache();
    }

    /**
     * @param DRI_Workflow_Template $template
     * @param DRI_Workflow_Task_Template $activityTemplate
     */
    public function copyForms(DRI_Workflow_Template $template, DRI_Workflow_Task_Template $activityTemplate) {
        $this->load_relationship("forms");
        foreach ($this->forms->getBeans() as $formBase) {
            /** @var \CJ_Form $form */
            $form = clone $formBase;
            $form->id = \Dotbcrm\Dotbcrm\Util\Uuid::uuid4();
            $form->new_with_id = true;
            $form->dri_workflow_template_id = $template->name;
            $form->dri_workflow_template_name = $template->id;
            $form->activity_template_id = $activityTemplate->id;
            $form->activity_template_name = $activityTemplate->name;
            $form->save();
            BeanFactory::unregisterBean($form);
        }
    }

    /**
     *
     */
    public function deleteForms() {
        $this->load_relationship("forms");
        foreach ($this->forms->getBeans() as $form) {
            /** @var \CJ_Form $form */
            $form->mark_deleted($form->id);
        }
    }

    /**
     * Clears the cache used when updating activity due dates from the parent if this is needed.
     */
    private function clearParentActivityDatesCache()
    {
        if ($this->task_due_date_type === self::TASK_DUE_DATE_TYPE_DAYS_FROM_PARENT_DATE_FIELD) {
            require_once 'modules/DRI_Workflows/LogicHook/ParentHook.php';
            DRI_Workflows_LogicHook_ParentHook::clearParentActivityDatesCache($this->due_date_module);
        }
    }

    /**
     * @return bool
     * @throws DotbQueryException
     */
    public function isParent()
    {
        return count($this->getChildren()) > 0;
    }

    /**
     * @return DRI_Workflow_Task_Template[]
     * @throws DotbQueryException
     */
    public function getChildren()
    {
        $bean = \BeanFactory::newBean('DRI_Workflow_Task_Templates');

        $query = new \DotbQuery();
        $query->from($bean);
        $query->select('*');
        $query->orderBy('sort_order', 'ASC');
        $query->where()->equals('parent_id', $this->id);

        $activities = $bean->fetchFromQuery($query);

        return $this->sortChildren($activities);
    }

    /**
     * Since all php functions that sorts an array based on a function is blacklisted by the package scanner
     * we have to implement our own algorithm, this is based on quicksort
     *
     * @param \DRI_Workflow_Task_Template[] $activities
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
        $pivot = $pivotActivity->getChildOrder();

        foreach ($activities as $k => $activity) {
            $order = $activity->getChildOrder();
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

    /**
     * @return int
     */
    public function getChildOrder()
    {
        $order = $this->sort_order;

        if (false !== strpos($order, '.')) {
            list($_, $order) = explode('.', $order);
        }

        return (int) $order;
    }

    /**
     * @return DRI_Workflow_Task_Template
     */
    public function getParent()
    {
        return $this->hasParent()
            ? BeanFactory::retrieveBean('DRI_Workflow_Task_Templates', $this->parent_id)
            : null;
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        return !empty($this->parent_id);
    }

    /**
     * @return bool
     */
    public function hasStageTemplate()
    {
        return !empty($this->dri_subworkflow_template_id);
    }

    /**
     * @return DRI_SubWorkflow_Template
     */
    public function getStageTemplate()
    {
        return $this->hasStageTemplate()
            ? BeanFactory::retrieveBean('DRI_SubWorkflow_Templates', $this->dri_subworkflow_template_id)
            : null;
    }

    /**
     * @return bool
     */
    public function hasJourneyTemplate()
    {
        return !empty($this->dri_subworkflow_template_id);
    }

    /**
     * @return DRI_Workflow_Template
     */
    public function getJourneyTemplate()
    {
        return $this->hasJourneyTemplate()
            ? BeanFactory::retrieveBean('DRI_Workflow_Templates', $this->dri_workflow_template_id)
            : null;
    }

    /**
     * @return DRI_SubWorkflow_Template
     */
    public function getPreviousStageTemplate()
    {
        return !empty($this->fetched_row['dri_subworkflow_template_id'])
            ? BeanFactory::retrieveBean('DRI_SubWorkflow_Templates', $this->fetched_row['dri_subworkflow_template_id'])
            : null;
    }

    /**
     * @return DRI_Workflow_Task_Template[]
     */
    public function getBlockedBy()
    {
        if (empty($this->blocked_by)) {
            return array ();
        }

        $blockedBy = array ();

        foreach ($this->getBlockedByIds() as $id) {
            $blockedBy[] = BeanFactory::retrieveBean('DRI_Workflow_Task_Templates', $id);
        }

        return $blockedBy;
    }

    /**
     * @return string[]
     */
    public function getBlockedByIds()
    {
        if (empty($this->blocked_by)) {
            return array ();
        }

        return is_string($this->blocked_by)
            ? json_decode($this->blocked_by, true)
            : (is_array($this->blocked_by) ? $this->blocked_by : array ());
    }

    /**
     * @return bool
     */
    public function isBlocked()
    {
        return count($this->getBlockedByIds()) > 0;
    }

    /**
     * @return bool
     */
    public function hasBlockedBy()
    {
        return count($this->getBlockedByIds()) > 0;
    }

    /**
     * @throws DotbApiExceptionInvalidParameter
     */
    private function validateUniqueName()
    {
        try {
            self::getByNameAndParent($this->name, $this->dri_subworkflow_template_id, $this->id);
            throw new DotbApiExceptionInvalidParameter(sprintf('template with name %s does already exist', $this->name));
        } catch (DRI_Workflow_Task_Templates_Exception_NotFound $e) {}
    }

    private function setSortOrder()
    {
        if (empty($this->sort_order)) {
            $bean = \BeanFactory::newBean('DRI_Workflow_Task_Templates');

            $query = new \DotbQuery();
            $query->from($bean);
            $query->select('sort_order');
            $query->orderBy('sort_order', 'ASC');
            $query->limit(1);
            $query->where()->equals('dri_subworkflow_template_id', $this->dri_subworkflow_template_id);

            $rows = $query->execute();

            if (empty($rows)) {
                $this->sort_order = '1';
            } else {
                $this->sort_order = $rows[0]['sort_order'] + 1;
            }
        }
    }

    private function setJourneyTemplate()
    {
        if ($this->hasStageTemplate()) {
            $stageTemplate = $this->getStageTemplate();

            if ($stageTemplate->hasJourneyTemplate()) {
                $journeyTemplate = $stageTemplate->getJourneyTemplate();

                $this->dri_workflow_template_id = $journeyTemplate->id;
                $this->dri_workflow_template_name = $journeyTemplate->name;
            }
        }
    }
}
