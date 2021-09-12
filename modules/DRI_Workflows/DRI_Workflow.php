<?php

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;
use Dotbcrm\Dotbcrm\Util\Uuid;

require_once 'modules/DRI_Workflow_Task_Templates/Activity/ActivityHooks.php';
require_once 'modules/DRI_Workflows/ProgressCalculator.php';
require_once 'modules/DRI_Workflows/StateCalculator.php';
require_once "modules/DRI_Workflows/MomentumCalculator.php";

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflow extends Basic
{
    const STATE_NOT_STARTED = 'not_started';
    const STATE_IN_PROGRESS = 'in_progress';
    const STATE_COMPLETED = 'completed';

    /**
     * DO NOT USE!
     *
     * old constants, we must keep this for some time
     * since older versions may be use these in cache files
     */
    const ASSIGN_TO_CURRENT_USER = 'current_user';
    const ASSIGN_TO_PARENT_ASSIGNEE = 'parent_assignee';

    /**
     * The key used in the vardef
     */
    const PARENT_VARDEF_KEY = 'customer_journey_parent';

    /**
     * Retrieves a DRI_Workflow with id $id and
     * returns a instance of the retrieved bean
     *
     * @param string $id: the id of the DRI_Workflow that should be retrieved
     * @return DRI_Workflow
     * @throws DRI_Workflows_Exception_IdNotFound: if not found
     */
    public static function getById($id)
    {
        if (empty($id)) {
            require_once 'modules/DRI_Workflows/Exception/IdNotFound.php';
            throw new DRI_Workflows_Exception_IdNotFound($id);
        }

        /** @var DRI_Workflow $bean */
        $bean = BeanFactory::retrieveBean('DRI_Workflows', $id, array (
            'disable_row_level_security' => true,
        ));

        if (null === $bean)
        {
            require_once 'modules/DRI_Workflows/Exception/IdNotFound.php';
            throw new DRI_Workflows_Exception_IdNotFound($id);
        }

        return $bean;
    }

    /**
     * Retrieves a DRI_Workflow with name $name and
     * returns a instance of the retrieved bean
     *
     * @param string $name: the name of the DRI_Workflow that should be retrieved
     * @return DRI_Workflow
     * @throws DRI_Workflows_Exception_NameNotFound
     */
    public static function getByName($name)
    {
        $db = DBManagerFactory::getInstance();

        $sql = <<<SQL
            SELECT id
            FROM dri_workflows
            WHERE name = '%s' AND
                deleted = 0
SQL;

        $sql = sprintf($sql, $db->quote($name));
        $id = $db->getOne($sql);

        if (empty($id))
        {
            require_once 'modules/DRI_Workflows/Exception/NameNotFound.php';
            throw new DRI_Workflows_Exception_NameNotFound($name);
        }

        return self::getById($id);
    }

    /**
     * @return array
     */
    public static function listEnabledModulesEnumOptions()
    {
        static $blackList = array (
            'Home',
            'DRI_Workflows',
            'DRI_SubWorkflows',
            'Forecasts',
            'Feeds',
            'iFrames',
            'Worksheet',
            'Queues',
            'FAQ',
            'Newsletters',
            'Tags',
            'Library',
            'Words',
            'Dotb_Favorites',
            'KBDocuments',
            'Reports',
            'Dashboards',
            'pmse_Project',
            'pmse_Inbox',
            'pmse_Business_Rules',
            'pmse_Emails_Templates',
            'Currencies',
            'CJ_Forms',
            'CJ_WebHooks',
            'BusinessCenters',
            'UserSignatures',
        );

        static $whiteList = array (
            'ProspectLists',
            'Prospects'
        );

        $list = array ();

        foreach ($GLOBALS['app_list_strings']['moduleList'] as $module => $name) {
            if (!in_array($module, $GLOBALS['bwcModules'], true) && (
                    (!in_array($module, $blackList, true) && !in_array($module, $GLOBALS['modInvisList'], true))
                        || in_array($module, $whiteList, true)
                ))
            {
                $list[$module] = $name;
            }
        }

        return $list;
    }

    /**
     * @param DotbBean $parent
     * @param string $template_id
     * @return DRI_Workflow
     * @throws Exception
     */
    public static function start(\DotbBean $parent, $template_id)
    {
        // enable activity logging during creation
        if (DotbConfig::getInstance()->get('customer_journey.disable_activity_stream_on_create', true)) {
            Activity::disable();
        }

        // enable tracker logging during creation
        if (DotbConfig::getInstance()->get('customer_journey.disable_tracker_on_create', true)) {
            TrackerManager::getInstance()->pause();
        }

        try {
            $journey = new \DRI_Workflow();
            $journey->id = Uuid::uuid1();
            $journey->new_with_id = true;

            if (empty($GLOBALS['current_user']->id)) {
                $journey->update_modified_by = false;
                $journey->set_created_by = false;
                $journey->created_by = $parent->created_by;
                $journey->modified_user_id = $parent->modified_user_id;
            }

            BeanFactory::registerBean($journey);
            $journey->populateFromParent($parent, $template_id);
            $journey->save();

            // re disable after the save so we aren't affecting other parts of the system
            if (DotbConfig::getInstance()->get('customer_journey.disable_activity_stream_on_create', true)) {
                Activity::enable();
            }

            if (DotbConfig::getInstance()->get('customer_journey.disable_tracker_on_create', true)) {
                TrackerManager::getInstance()->unPause();
            }

            return $journey;
        } catch (\Exception $e) {
            $GLOBALS['log']->fatal("$e");
            throw $e;
        }
    }

    public $disable_row_level_security = false;
    public $new_schema = true;
    public $module_dir = 'DRI_Workflows';
    public $object_name = 'DRI_Workflow';
    public $table_name = 'dri_workflows';
    public $importable = false;
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
    public $state;
    public $progress;
    public $points;
    public $score;
    public $parent_id;
    public $parent_name;
    public $parent_type;
    public $type;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $account_id;
    public $account_name;
    public $account_link;
    public $contact_id;
    public $contact_name;
    public $contact_link;
    public $lead_id;
    public $lead_name;
    public $lead_link;
    public $opportunity_id;
    public $opportunity_name;
    public $opportunity_link;
    public $available_modules;
    public $assignee_rule;
    public $target_assignee;
    public $activities;
    public $following;
    public $following_link;
    public $favorite_link;
    public $tag;
    public $tag_link;
    public $case_id;
    public $case_name;
    public $case_link;
    public $enabled_modules;
    public $locked_fields;
    public $locked_fields_link;
    public $acl_team_set_id;
    public $acl_team_names;
    public $date_started;
    public $date_completed;
    public $momentum_ratio;
    public $momentum_points;
    public $momentum_score;
    public $archived;

    /**
     * @var Link2
     */
    public $dri_subworkflows;

    /**
     * @var Link2
     */
    public $current_activity_call;

    /**
     * @var Link2
     */
    public $current_activity_task;

    /**
     * @var Link2
     */
    public $current_activity_meeting;

    /**
     * @var string
     */
    public $current_stage_id;

    /**
     * @var string
     */
    public $current_stage_name;

    /**
     * @var Link2
     */
    public $current_stage_link;

    /**
     * @var Link2
     */
    public $dri_subworkflow_link;

    /**
     * @var string
     */
    public $dri_workflow_template_id;

    /**
     * @var string
     */
    public $dri_workflow_template_name;

    /**
     * @var Link2
     */
    public $dri_workflow_template_link;

    /**
     * @var DRI_SubWorkflow[]
     */
    private $stages;

    /**
     * @param string $interface
     * @param boolean
     * @return bool
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
     * @return boolean
     */
    public function isNew()
    {
        return empty($this->id) || (!empty($this->id) && !empty($this->new_with_id));
    }

    /**
     * @param bool $save
     * @throws DRI_Workflows_Exception_IdNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     */
    private function calculateProgress($save = true)
    {
        $calculator = new \DRI_Workflows\ProgressCalculator($this);
        $calculator->calculate($save);
    }

    /**
     * @throws DRI_Workflows_Exception_IdNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     */
    private function calculateMomentum()
    {
        $calculator = new \DRI_Workflows\MomentumCalculator($this);
        $calculator->calculate();
    }

    /**
     * @param string $trigger_event
     * @param \DotbBean $parent
     * @param array $data
     * @param \DRI_Workflow_Template $template
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiException
     * @throws DotbQueryException
     */
    public function sendWebHooks(
        $trigger_event,
        \DotbBean $parent = null,
        \DRI_Workflow_Template $template = null,
        array $data = null
    ) {
        if ($parent === null) {
            $parent = $this->getParent();
        }

        if ($template === null) {
            $template = $this->getTemplate();
        }

        if ($data === null) {
            $data = $this->toArray(true);
        }

        $template->sendWebHooks($trigger_event, array (
            'parent_module' => $parent->module_dir,
            'parent' => $parent->toArray(true),
            'journey' => $data
        ));
    }

    /**
     * @param boolean $check_notify
     * @return string
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    public function save($check_notify = FALSE)
    {
        $isNew = $this->isNew();
        $template = null;

        if (!empty($this->dri_workflow_template_id) && $isNew) {
            try {
                $template = $this->getTemplate();
                $this->populateFromTemplate($template);
                $check_notify = $this->assigned_user_id !== $GLOBALS['current_user']->id;
            } catch (DRI_Workflow_Templates_Exception_IdNotFound $e) {
                throw $e;
            }
        }

        if ($isNew) {
            $this->state = self::STATE_IN_PROGRESS;
            $this->progress = 0;
            $this->score = 0;
        }

        if ($isNew) {
            $this->sendWebHooks(\CJ_WebHook::TRIGGER_EVENT_BEFORE_CREATE);
        }

        if ($isNew && !empty($this->dri_workflow_template_id) && $template !== null) {
            // disable resaving of the journey during creation
            DRI_Workflow_Task_Templates_Activity_ActivityHooks::disable($this->id);
            $this->createStagesFromTemplate($template);
            DRI_Workflow_Task_Templates_Activity_ActivityHooks::enable($this->id);
        } else {
            $this->calculateState();
            $this->calculateProgress();
            $this->calculateMomentum();
        }

        $this->setCurrentStageAndActivity();
        $this->setName();

        if ($this->state === self::STATE_COMPLETED && empty($this->date_completed)) {
            $this->date_completed = \TimeDate::getInstance()->now();
        }

        if ($this->state === self::STATE_IN_PROGRESS && empty($this->date_started)) {
            $this->date_started = \TimeDate::getInstance()->now();
        }

        $changedToCompleted = $this->changedToCompleted();
        $changedToInProgress = $this->changedToInProgress();

        if ($changedToInProgress) {
            $this->sendWebHooks(\CJ_WebHook::TRIGGER_EVENT_BEFORE_IN_PROGRESS);
        }

        if ($changedToCompleted) {
            $this->sendWebHooks(\CJ_WebHook::TRIGGER_EVENT_BEFORE_COMPLETED);
        }

        $return = parent::save($check_notify);

        if ($changedToInProgress) {
            $this->sendWebHooks(\CJ_WebHook::TRIGGER_EVENT_AFTER_IN_PROGRESS);
        }

        if ($changedToCompleted) {
            $this->sendWebHooks(\CJ_WebHook::TRIGGER_EVENT_AFTER_COMPLETED);
        }

        if ($isNew) {
            $this->sendWebHooks(\CJ_WebHook::TRIGGER_EVENT_AFTER_CREATE);
        }

        return $return;
    }

    /**
     * @return bool
     */
    public function changedToInProgress()
    {
        return $this->stateChangedTo(self::STATE_IN_PROGRESS);
    }

    /**
     * @return bool
     */
    public function changedToCompleted()
    {
        return $this->stateChangedTo(self::STATE_COMPLETED);
    }

    /**
     * @param $state
     * @return bool
     */
    private function stateChangedTo($state)
    {
        return $this->isFieldChanged('state') && $this->state === $state;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isFieldChanged($name)
    {
        $value = $this->{$name};

        if ($this->isNew()) {
            $def = $this->getFieldDefinition($name);
            return isset($def['default']) ? $def['default'] != $value : !empty($value);
        }

        return is_array($this->fetched_row)
            && isset($this->fetched_row[$name])
            && $this->fetched_row[$name] != $value;
    }

    /**
     *
     */
    private function setName()
    {
        $parentName = null;

        foreach ($this->getParentDefinitions() as $parentDef) {
            if (!empty($this->{$parentDef['id_name']})) {
                // if the name have not been populated, only the id
                // make sure to retrieve and populate it
                if (empty($this->{$parentDef['name']})) {
                    $parent = BeanFactory::retrieveBean(
                        $parentDef['module'],
                        $this->{$parentDef['id_name']},
                        array ('disable_row_level_security' => true)
                    );

                    if ($parent) {
                        $this->{$parentDef['name']} = $parent->name;
                    }
                }

                // use the first available name according to the prio list
                if (!empty($this->{$parentDef['name']})) {
                    $parentName = $this->{$parentDef['name']};
                    break;
                }
            }
        }

        if (!empty($parentName)) {
            $this->name = sprintf('%s - %s', $parentName, $this->dri_workflow_template_name);
        } else {
            $this->name = $this->dri_workflow_template_name;
        }
    }

    /**
     * @throws DotbApiExceptionError
     */
    private function setCurrentStageAndActivity()
    {
        foreach ($this->getStages() as $stage) {
            if (!$stage->isCompleted()) {
                $this->current_stage_id = $stage->id;
                $this->current_stage_name = $stage->name;

                foreach ($stage->getActivities() as $activity) {
                    $handler = ActivityHandlerFactory::factory($activity->module_dir);

                    if (!$handler->isCompleted($activity)) {
                        $this->parent_id = $activity->id;
                        $this->parent_name = $activity->name;
                        $this->parent_type = $activity->module_dir;
                        break;
                    }
                }

                break;
            }
        }
    }

    /**
     * Retrieves the next activity in the journey after a given activity
     *
     * @param DRI_SubWorkflow $stage
     * @param \DotbBean $activity
     * @return \DotbBean|bool
     * @throws DotbApiExceptionError
     */
    public function getNextActivity(DRI_SubWorkflow $stage, \DotbBean $activity)
    {
        $next = $stage->getNextActivity($activity);

        while ($stage && !$next) {
            $stage = $this->getNextStage($stage);

            if ($stage) {
                $next = $stage->getFirstActivity();
            }
        }

        return $next;
    }

    /**
     * @param DRI_SubWorkflow $stage
     * @return DRI_SubWorkflow|bool
     * @throws DotbApiExceptionError
     */
    public function getNextStage(DRI_SubWorkflow $stage)
    {
        foreach ($this->getStages() as $next) {
            if (!$next->deleted && $next->sort_order > $stage->sort_order) {
                return $next;
            }
        }

        return false;
    }

    /**
     * @param bool $save
     */
    private function calculateState($save = true)
    {
        $calculator = new DRI_Workflows\StateCalculator($this);
        $calculator->calculate($save);
    }

    /**
     * @param bool $save
     */
    private function calculateStageStates($save = true)
    {
        $calculator = new DRI_Workflows\StateCalculator($this);
        $calculator->calculateStageStates($save);
    }

    /**
     * @param DRI_Workflow_Template $template
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    private function createStagesFromTemplate(DRI_Workflow_Template $template)
    {
        /** @var DRI_SubWorkflow[] $stages */
        $stages = array ();

        foreach ($template->getStageTemplates() as $stageTemplate) {
            $stage = new DRI_SubWorkflow();
            $stage->id = create_guid();
            $stage->new_with_id = true;
            $stage->created_from_journey = true;

            if (empty($GLOBALS['current_user']->id)) {
                $stage->update_modified_by = false;
                $stage->set_created_by = false;
                $stage->created_by = $this->created_by;
                $stage->modified_user_id = $this->modified_user_id;
            }

            BeanFactory::registerBean($this);
            BeanFactory::registerBean($stage);
            $stage->setJourney($this);
            $stage->populateFromJourney($this);
            $stage->populateFromTemplate($stageTemplate);
            $stage->createActivitiesFromTemplate(false);
            BeanFactory::unregisterBean($stage);
            $stages[] = $stage;
        }

        $this->setStages($stages);

        $this->calculateStageStates(false);
        $this->calculateState(false);
        $this->calculateProgress(false);

        foreach ($stages as $stage) {
            BeanFactory::registerBean($this);
            BeanFactory::registerBean($stage);
            $stage->setJourney($this);
            $stage->save();
            BeanFactory::unregisterBean($stage);
        }
    }

    /**
     * @param DRI_Workflow_Template $template
     */
    private function populateFromTemplate(DRI_Workflow_Template $template)
    {
        $this->dri_workflow_template_id = $template->id;
        $this->dri_workflow_template_name = $template->name;
        $this->name = $template->name;
        $this->description = $template->description;
        $this->type = $template->type;
        $this->available_modules = $template->available_modules;
        $this->assignee_rule = $template->assignee_rule;
        $this->target_assignee = $template->target_assignee;
        $this->points = $template->points ?: 0;
        $this->assigned_user_id = $this->getTargetAssigneeId();
        $this->team_id = $this->getTargetTeamId();
        $this->team_set_id = $this->getTargetTeamSetId();
    }

    /**
     * @return string
     */
    public function getAssigneeRule()
    {
        return $this->assignee_rule;
    }

    /**
     * @return string
     * @throws DRI_Workflows_Exception_ParentNotFound
     */
    public function getTargetAssigneeId()
    {
        switch ($this->target_assignee) {
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_CURRENT_USER:
                if (!empty($GLOBALS['current_user']->id)) {
                    return $GLOBALS['current_user']->id;
                } else {
                    return $this->created_by;
                }

            case \DRI_Workflow_Template::TARGET_ASSIGNEE_PARENT:
                return $this->getParent()->assigned_user_id;
        }

        return null;
    }

    /**
     * @return string
     * @throws DRI_Workflows_Exception_ParentNotFound
     */
    public function getTargetTeamId()
    {
        switch ($this->target_assignee) {
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_CURRENT_USER:
                return !empty($GLOBALS['current_user']->id) ? $GLOBALS['current_user']->default_team : '1';
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_PARENT:
                return $this->getParent()->team_id;
        }

        return null;
    }

    /**
     * @return string
     * @throws DRI_Workflows_Exception_ParentNotFound
     */
    public function getTargetTeamSetId()
    {
        switch ($this->target_assignee) {
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_CURRENT_USER:
                return !empty($GLOBALS['current_user']->id) ? $GLOBALS['current_user']->team_set_id : '1';
            case \DRI_Workflow_Template::TARGET_ASSIGNEE_PARENT:
                return $this->getParent()->team_set_id;
        }

        return null;
    }

    /**
     * @param DotbBean $parent
     * @param string $template_id
     */
    public function populateFromParent(\DotbBean $parent, $template_id)
    {
        $this->dri_workflow_template_id = $template_id;

        foreach ($this->getParentDefinitions() as $parentDef) {
            if ($parentDef['module'] === $parent->module_dir) {
                $this->{$parentDef['id_name']} = $parent->id;
                $this->{$parentDef['name']} = $parent->name;
            }
        }
    }

    /**
     * @return DRI_Workflow_Template
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     */
    public function getTemplate()
    {
        return DRI_Workflow_Template::getById($this->dri_workflow_template_id);
    }

    /**
     * @param string $module
     * @return \DotbBean
     * @throws DRI_Workflows_Exception_ParentNotFound
     */
    public function getParent($module = null)
    {
        $parent = null;

        foreach ($this->getParentDefinitions() as $parentDef) {
            if (!empty($this->{$parentDef['id_name']}) && (null === $module || $module === $parentDef['module'])) {
                $parent = BeanFactory::retrieveBean($parentDef['module'], $this->{$parentDef['id_name']}, array (
                    'disable_row_level_security' => true,
                ));

                break;
            }
        }

        if ($parent instanceof DotbBean && !empty($parent->id)) {
            return $parent;
        }

        require_once 'modules/DRI_Workflows/Exception/ParentNotFound.php';
        throw new DRI_Workflows_Exception_ParentNotFound();
    }

    /**
     * @return array
     */
    public function getParentDefinitions()
    {
        $unsorted = array ();

        foreach ($this->getFieldDefinitions() as $def) {
            if (!empty($def[self::PARENT_VARDEF_KEY]['enabled'])) {
                $unsorted[$def[DRI_Workflow::PARENT_VARDEF_KEY]['rank']][] = $def;
            }
        }

        $sorted = array ();
        ksort($unsorted);

        foreach ($unsorted as $defs) {
            foreach ($defs as $def) {
                $sorted[] = $def;
            }
        }

        return $sorted;
    }

    /**
     * Loads the complete journey into memory
     */
    public function load()
    {
        $this->loadStages();
        $this->loadActivities();
    }

    /**
     * @param DotbBean $activity
     * @throws DotbApiExceptionError
     */
    public function insertActivity(\DotbBean $activity)
    {
        foreach ($this->getStages() as $stage) {
            if ($stage->hasActivity($activity)) {
                $stage->insertActivity($activity);
            }
        }
    }

    /**
     * loads all stages related to the journey
     */
    private function loadStages()
    {
        if (null === $this->stages) {
            $bean = \BeanFactory::newBean('DRI_SubWorkflows');

            $query = new \DotbQuery();
            $query->from($bean);
            $query->select('*');
            $query->orderBy('sort_order', 'ASC');
            $query->where()
                ->equals('dri_workflow_id', $this->id);

            $this->setStages($bean->fetchFromQuery($query));

            // register all stages in the global bean cache
            foreach ($this->stages as $stage) {
                BeanFactory::registerBean($stage);
            }
        }
    }

    /**
     * Reloads activities
     */
    public function reloadStages()
    {
        $this->stages = null;
        $this->loadStages();
    }

    /**
     * @param array $stages
     */
    private function setStages(array $stages)
    {
        $this->stages = $stages;
    }

    /**
     * @return DRI_SubWorkflow[]
     * @throws DotbApiExceptionError
     */
    public function getStages()
    {
        // We should not attempt to load the stages if the bean is new,
        // this is both unnecessary and very dangerous.
        if (empty($this->id)) {
            return array ();
        }

        $this->loadStages();

        return array_values($this->stages);
    }

    /**
     * @return array
     * @throws DotbApiExceptionError
     */
    public function getStageIds()
    {
        $ids = array ();

        foreach ($this->getStages() as $stage) {
            $ids[] = $stage->id;
        }

        return $ids;
    }

    /**
     * loads all activities related to the journey
     *
     * @throws DotbApiExceptionError
     * @throws DotbQueryException
     */
    private function loadActivities()
    {
        // load all activities related to the journey
        $activities = array();
        foreach (ActivityHandlerFactory::all() as $activityHandler) {
            $query = $activityHandler->createLoadQuery();
            $query->where()->in($activityHandler->getStageIdFieldName(), $this->getStageIds());
            $bean = \BeanFactory::newBean($activityHandler->getModuleName());
            $activities = array_merge($activities, $bean->fetchFromQuery($query));
        }

        // register all activities in the global bean cache
        foreach ($activities as $activity) {
            BeanFactory::registerBean($activity);
        }

        // split up the activities between the stage it belongs to
        foreach ($this->getStages() as $stage) {
            $filtered = array();

            foreach ($activities as $activity) {
                $handler = ActivityHandlerFactory::factory($activity);
                if ($handler->getStageId($activity) === $stage->id) {
                    $filtered[] = $activity;
                }
            }

            $stage->setLoadedActivities(array_values($filtered));
        }
    }

    /**
     * @param DRI_Workflow_Task_Template $activityTemplate
     * @return \DotbBean|false
     * @throws DotbApiExceptionError
     */
    public function getActivityByTemplate(DRI_Workflow_Task_Template $activityTemplate)
    {
        foreach ($this->getStages() as $stage) {
            foreach ($stage->getActivities() as $activity) {
                $handler = ActivityHandlerFactory::factory($activity->module_dir);
                if ($handler->getActivityTemplateId($activity) === $activityTemplate->id) {
                    return $activity;
                }

                foreach ($handler->getChildren($activity) as $child) {
                    $handler = ActivityHandlerFactory::factory($child->module_dir);
                    if ($handler->getActivityTemplateId($child) === $activityTemplate->id) {
                        return $child;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param string $id
     * @return \DotbBean|false
     * @throws DotbApiExceptionError
     */
    public function getActivityByTemplateId($id)
    {
        foreach ($this->getStages() as $stage) {
            foreach ($stage->getActivities() as $activity) {
                $handler = ActivityHandlerFactory::factory($activity->module_dir);

                if ($handler->getActivityTemplateId($activity) === $id) {
                    return $activity;
                }

                if ($handler->isParent($activity)) {
                    foreach ($handler->getChildren($activity) as $child) {
                        $handler = ActivityHandlerFactory::factory($child->module_dir);
                        if ($handler->getActivityTemplateId($child) === $id) {
                            return $child;
                        }
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param int $id
     * @param bool $encode
     * @param bool $deleted
     * @return Basic|null
     */
    public function retrieve($id = -1, $encode = true, $deleted = true)
    {
        $return = parent::retrieve($id, $encode, $deleted);
        $this->stages = null;
        return $return;
    }

    /**
     * @param string $id
     * @throws DotbApiExceptionError
     */
    public function mark_deleted($id)
    {
        if ($this->id != $id) {
            $this->retrieve($id);
        }

        $this->load();

        $stages = $this->getStages();
        $data = $this->toArray(true);

        try {
            $parent = $this->getParent();
        } catch (\Exception $e) {
            $parent = null;
        }

        try {
            $template = $this->getTemplate();
        } catch (\Exception $e) {
            $template = null;
        }

        if ($parent && $template) {
            $this->sendWebHooks(
                CJ_WebHook::TRIGGER_EVENT_BEFORE_DELETE,
                $parent,
                $template,
                $data
            );
        }

        parent::mark_deleted($id);

        foreach ($stages as $stage) {
            $stage->mark_deleted($stage->id);
        }

        if ($parent && $template) {
            $this->sendWebHooks(
                CJ_WebHook::TRIGGER_EVENT_BEFORE_DELETE,
                $parent,
                $template,
                $data
            );
        }
    }

    /**
     * @return array
     */
    public function getAvailableModules()
    {
        return unencodeMultienum($this->available_modules);
    }
}
