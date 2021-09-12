<?php

class CJ_Form extends Basic
{
    const TRIGGER_EVENT_COMPLETED = 'completed';
    const TRIGGER_EVENT_IN_PROGRESS = 'in_progress';
    const TRIGGER_EVENT_NOT_APPLICABLE = 'not_applicable';

    const ACTION_TYPE_VIEW_RECORD = 'view_record';
    const ACTION_TYPE_CREATE_RECORD = 'create_record';
    const ACTION_TYPE_UPDATE_RECORD = 'update_record';

    const TABLE_NAME = 'cj_forms';

    public $disable_row_level_security = false;
    public $new_schema = true;
    public $module_dir = 'CJ_Forms';
    public $object_name = 'CJ_Form';
    public $table_name = self::TABLE_NAME;
    public $importable = true;

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
    public $activities;
    public $following;
    public $following_link;
    public $my_favorite;
    public $favorite_link;
    public $tag;
    public $tag_link;
    public $commentlog;
    public $commentlog_link;
    public $locked_fields;
    public $locked_fields_link;
    public $team_id;
    public $team_set_id;
    public $acl_team_set_id;
    public $team_count;
    public $team_name;
    public $acl_team_names;
    public $team_link;
    public $team_count_link;
    public $teams;
    public $trigger_event;
    public $action_type;
    public $parent_module;
    public $relationship;
    public $activity_template_id;
    public $activity_template_name;
    public $activity_template_link;
    public $dri_workflow_template_id;
    public $dri_workflow_template_name;
    public $dri_workflow_template_link;
    public $activity_module;
    public $active;

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

    public static function getRelationshipEnumValues()
    {
        $values = array_merge(
            array ('' => ''),
            self::addValuesForModule('Tasks', 'Tasks', 'Tasks', null),
            self::addValuesForModule('Meetings', 'Meetings', 'Meetings', null),
            self::addValuesForModule('Calls', 'Calls', 'Calls', null)
        );

        ksort($values);
        return $values;
    }

    public static function addValuesForModule(
        $module,
        $prefix,
        $prefixName,
        $skipLink,
        $depth = 0
    ) {
        $GLOBALS['log']->fatal("loading $module");
        $bean = BeanFactory::newBean($module);

        $values = array ();

        if (!$bean) {
            return $values;
        }

        foreach ($bean->getFieldDefinitions() as $def) {
            if (isset($def['type']) &&
                isset($def['module']) &&
                isset($def['vname']) &&
                isset($def['name']) &&
                $def['type'] === 'link' &&
                !in_array($def['name'], array (
                    'created_by_link',
                    'modified_user_link',
                    'activities',
                    'activities_users',
                    'activities_teams',
                    'comments',
                    'teams',
                    'team_link',
                    'team_count_link',
                    'email_attachment_for',
                    'assigned_user_link',
                    'current_cj_activity_at',
                    'current_activity_call',
                    'current_activity_meeting',
                    'current_activity_task',
                    'current_stage_at',
                    'dri_workflow_template_link',
                    'dri_subworkflow_template_link',
                    'cj_activity_tpl_link',
                    'archived_emails',
                    'blocked_by_link',
                ))
            ) {
                $key = "$prefix:{$def['name']}";

                if (isset($def['vname'])) {
                    $vname = translate($def['vname'], $module);
                    $name = "$prefixName › $vname ({$def['name']})";
                } else {
                    $name = "$prefixName › {$def['name']}";
                }

                $values[$key] = $name;

                if ($depth < 2) {
                    $values = array_merge(
                        $values,
                        self::addValuesForModule($def['module'], $key, $name, $skipLink, $depth + 1)
                    );
                }
            }
        }

        return $values;
    }

    public function save($check_notify = false)
    {
        $this->validateUniqueTriggerEvent();
        return parent::save($check_notify);
    }

    /**
     * @throws DotbApiExceptionInvalidParameter
     */
    private function validateUniqueTriggerEvent()
    {
        if (!$this->active) {
            return;
        }

        $query = new DotbQuery();
        $query->from(BeanFactory::newBean('CJ_Forms'));
        $query->select('id');
        $query->where()
            ->equals('active', true)
            ->equals('activity_template_id', $this->activity_template_id)
            ->equals('trigger_event', $this->trigger_event);

        if (!empty($this->id)) {
            $query->where()->notEquals('id', $this->id);
        }

        $results = $query->execute();

        if (count($results) > 0) {
            $message = translate('LBL_DUPLICATE_TRIGGER_EVENT_FOUND_ERROR', 'CJ_Forms');
            $event = translate('cj_forms_trigger_event_list', 'CJ_Forms', $this->trigger_event);
            $message = sprintf($message, $event);
            throw new DotbApiExceptionInvalidParameter($message);
        }
    }
}
