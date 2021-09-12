<?php

$dictionary['Task'] = array(
    'table' => 'tasks',
    'audited' => true,
    'unified_search' => true,
    'full_text_search' => true,
    'activity_enabled' => true,
    'fields' => array(
        'name' => array(
            'name' => 'name',
            'vname' => 'LBL_SUBJECT',
            'dbType' => 'varchar',
            'type' => 'name',
            'unified_search' => true,
            'full_text_search' => array(
                'enabled' => true,
                'searchable' => true,
                'boost' => 1.45,
            ),
            'importable' => 'required',
            'required' => true,
        ),
        'status' => array(
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'options' => 'task_status_dom',
            'len' => 100,
            'required' => true,
            'default' => 'Not Started',
            'duplicate_on_record_copy' => 'no',
            'full_text_search' => array(
                'enabled' => true,
                'searchable' => false,
            ),
        ),
        'remind_email' => array(
            'name' => 'remind_email',
            'vname' => 'LBL_REMINDER_EMAIL',
            'type' => 'enum',
            'options' => 'reminder_time_options'
        ),
        'remind_email_sent' => array(
            'name' => 'remind_email_sent',
            'vname' => 'LBL_EMAIL_REMINDER_SENT',
            'type' => 'bool',
            'default' => 0
        ),
        'remind_popup' => array(
            'name' => 'remind_popup',
            'vname' => 'LBL_REMINDER_POPUP',
            'type' => 'enum',
            'options' => 'reminder_time_options'
        ),
        'call_relate' => array(
            'name' => 'call_relate',
            'vname' => 'LBL_CALL_RELATE',
            'type' => 'varchar',
            'len' => 36
        ),
        'task_duration' => array(
            'name' => 'task_duration',
            'vname' => 'LBL_DURATION',
            'type' => 'enum',
            'options' => 'tasks_duration_options'
        ),
        'duration' => array(
            'name' => 'duration',
            'vname' => 'LBL_DATE_END_DURATION',
            'type' => 'int'
        ),
        'date_due' => array(
            'name' => 'date_due',
            'vname' => 'LBL_DUE_DATE',
            'type' => 'datetime',
            'studio' => array('required' => true, 'no_duplicate' => true),
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'full_text_search' => array(
                'type' => 'datetime',
                'enabled' => true,
                'searchable' => false,
            ),
            'time' => array(
                'step' => 5
            ),
            'dependency' => 'or(isInList(99999,createList($task_duration)),isNotLayoutRecord())'
        ),
        'time_due' => array(
            'name' => 'time_due',
            'vname' => 'LBL_DUE_TIME',
            'type' => 'datetime',
            //'db_concat_fields'=> array(0=>'date_due'),
            'source' => 'non-db',
            'importable' => 'false',
            'massupdate' => false,
        ),
        'date_start' => array(
            'name' => 'date_start',
            'vname' => 'LBL_START_DATE',
            'type' => 'datetime',
            'studio' => array('required' => true, 'no_duplicate' => true),
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'time' => array(
                'step' => 5
            )
        ),
        'parent_type' => array(
            'name' => 'parent_type',
            'vname' => 'LBL_PARENT_NAME',
            'type' => 'parent_type',
            'dbType' => 'varchar',
            'group' => 'parent_name',
            'options' => 'parent_type_display',
            'required' => false,
            'len' => '255',
            'comment' => 'The Dotb object to which the call is related',
            'studio' => array('wirelesslistview' => false),
            'options' => 'parent_type_display',
        ),
        'parent_name' => array(
            'name' => 'parent_name',
            'parent_type' => 'record_type_display',
            'type_name' => 'parent_type',
            'id_name' => 'parent_id',
            'vname' => 'LBL_LIST_RELATED_TO',
            'type' => 'parent',
            'group' => 'parent_name',
            'source' => 'non-db',
            'options' => 'parent_type_display',
            'studio' => true,
        ),
        'parent_id' => array(
            'name' => 'parent_id',
            'type' => 'id',
            'group' => 'parent_name',
            'reportable' => false,
            'vname' => 'LBL_PARENT_ID',
        ),
        'contact_id' => array(
            'name' => 'contact_id',
            'type' => 'id',
            'group' => 'contact_name',
            'reportable' => false,
            'vname' => 'LBL_CONTACT_ID',
        ),
        'contact_name' => array(
            'name' => 'contact_name',
            'rname' => 'name',
            'db_concat_fields' => array(
                0 => 'first_name',
                1 => 'last_name'
            ),
            'source' => 'non-db',
            'len' => '510',
            'group' => 'contact_name',
            'vname' => 'LBL_CONTACT_NAME',
            'reportable' => false,
            'id_name' => 'contact_id',
            'join_name' => 'contacts',
            'type' => 'relate',
            'module' => 'Contacts',
            'link' => 'contacts',
            'table' => 'contacts',
        ),
        'contact_phone' => array(
            'name' => 'contact_phone',
            'type' => 'relate',
            'source' => 'non-db',
            'link' => 'contacts',
            'module' => 'Contacts',
            'table' => 'contacts',
            'id_name' => 'contact_id',
            'rname' => 'phone_work',
            'vname' => 'LBL_CONTACT_PHONE',
            'studio' => array('listview' => true),
            'readonly' => true,
        ),
        'contact_email' => array(
            'name' => 'contact_email',
            'type' => 'varchar',
            'vname' => 'LBL_EMAIL_ADDRESS',
            'source' => 'non-db',
            'studio' => false
        ),
        'priority' => array(
            'name' => 'priority',
            'vname' => 'LBL_PRIORITY',
            'type' => 'enum',
            'options' => 'task_priority_dom',
            'len' => 100,
            'required' => true,
        ),
        'contacts' => array(
            'name' => 'contacts',
            'type' => 'link',
            'relationship' => 'contact_tasks',
            'source' => 'non-db',
            'side' => 'right',
            'vname' => 'LBL_CONTACT',
        ),
        'accounts' => array(
            'name' => 'accounts',
            'type' => 'link',
            'relationship' => 'account_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_ACCOUNTS',
        ),
        'opportunities' => array(
            'name' => 'opportunities',
            'type' => 'link',
            'relationship' => 'opportunity_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_OPPORTUNITY',
        ),
        'revenuelineitems' => array(
            'name' => 'revenuelineitems',
            'type' => 'link',
            'relationship' => 'revenuelineitem_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_REVENUELINEITEMS',
            'workflow' => false
        ),
        'cases' => array(
            'name' => 'cases',
            'type' => 'link',
            'relationship' => 'case_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_CASE',
        ),
        'bugs' => array(
            'name' => 'bugs',
            'type' => 'link',
            'relationship' => 'bug_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_BUGS',
        ),
        'emails' => array(
            'name' => 'emails',
            'type' => 'link',
            'relationship' => 'emails_tasks_rel',
            'source' => 'non-db',
            'vname' => 'LBL_EMAILS',
        ),
        'leads' => array(
            'name' => 'leads',
            'type' => 'link',
            'relationship' => 'lead_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_LEADS',
        ),
        'projects' => array(
            'name' => 'projects',
            'type' => 'link',
            'relationship' => 'projects_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_PROJECTS',
        ),
        'project_tasks' => array(
            'name' => 'project_tasks',
            'type' => 'link',
            'relationship' => 'project_tasks_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_PROJECT_TASKS',
        ),
        'notes' => array(
            'name' => 'notes',
            'type' => 'link',
            'relationship' => 'tasks_notes',
            'module' => 'Notes',
            'bean_name' => 'Note',
            'source' => 'non-db',
            'vname' => 'LBL_NOTES',
        ),
        'quotes' => array(
            'name' => 'quotes',
            'type' => 'link',
            'relationship' => 'quote_tasks',
            'vname' => 'LBL_QUOTES',
            'source' => 'non-db',
        ),
        'contact_parent' => array(
            'name' => 'contact_parent',
            'type' => 'link',
            'relationship' => 'contact_tasks_parent',
            'source' => 'non-db',
            'reportable' => false
        ),
        'meetings_parent' => array(
            'name' => 'meetings_parent',
            'type' => 'link',
            'relationship' => 'task_meetings_parent',
            'source' => 'non-db',
            'vname' => 'LBL_MEETINGS',
            'reportable' => false,
        ),
        'calls_parent' => array(
            'name' => 'calls_parent',
            'type' => 'link',
            'relationship' => 'task_calls_parent',
            'source' => 'non-db',
            'vname' => 'LBL_CALLS',
            'reportable' => false,
        ),
        'project' => array(
            'name' => 'project',
            'type' => 'link',
            'relationship' => 'projects_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_PROJECTS',
            'side' => 'right',
        ),
        'kbcontents' => array(
            'name' => 'kbcontents',
            'type' => 'link',
            'relationship' => 'kbcontent_tasks',
            'source' => 'non-db',
            'vname' => 'LBL_KBDOCUMENTS',
        ),
    ),
    'relationships' => array(
        'tasks_notes' => array(
            'lhs_module' => 'Tasks',
            'lhs_table' => 'tasks',
            'lhs_key' => 'id',
            'rhs_module' => 'Notes',
            'rhs_table' => 'notes',
            'rhs_key' => 'parent_id',
            'relationship_type' => 'one-to-many',
            'relationship_role_column' => 'parent_type',
            'relationship_role_column_value' => 'Tasks'
        ),
        'tasks_assigned_user' => array(
            'lhs_module' => 'Users',
            'lhs_table' => 'users',
            'lhs_key' => 'id',
            'rhs_module' => 'Tasks',
            'rhs_table' => 'tasks',
            'rhs_key' => 'assigned_user_id',
            'relationship_type' => 'one-to-many'
        ),
        'tasks_modified_user' => array(
            'lhs_module' => 'Users',
            'lhs_table' => 'users',
            'lhs_key' => 'id',
            'rhs_module' => 'Tasks',
            'rhs_table' => 'tasks',
            'rhs_key' => 'modified_user_id',
            'relationship_type' => 'one-to-many'
        ),
        'tasks_created_by' => array(
            'lhs_module' => 'Users',
            'lhs_table' => 'users',
            'lhs_key' => 'id',
            'rhs_module' => 'Tasks',
            'rhs_table' => 'tasks',
            'rhs_key' => 'created_by',
            'relationship_type' => 'one-to-many'
        ),
        'task_meetings_parent' => array(
            'lhs_module' => 'Tasks',
            'lhs_table' => 'tasks',
            'lhs_key' => 'id',
            'rhs_module' => 'Meetings',
            'rhs_table' => 'meetings',
            'rhs_key' => 'parent_id',
            'relationship_type' => 'one-to-many',
            'relationship_role_column' => 'parent_type',
            'relationship_role_column_value' => 'Tasks',
        ),
        'task_calls_parent' => array(
            'lhs_module' => 'Tasks',
            'lhs_table' => 'tasks',
            'lhs_key' => 'id',
            'rhs_module' => 'Calls',
            'rhs_table' => 'calls',
            'rhs_key' => 'parent_id',
            'relationship_type' => 'one-to-many',
            'relationship_role_column' => 'parent_type',
            'relationship_role_column_value' => 'Tasks',
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_tsk_name',
            'type' => 'index',
            'fields' => array('name')
        ),
        array(
            'name' => 'idx_task_con_del',
            'type' => 'index',
            'fields' => array('contact_id', 'deleted')
        ),
        array(
            'name' => 'idx_task_par_del',
            'type' => 'index',
            'fields' => array('parent_id', 'parent_type', 'deleted')
        ),
        array(
            'name' => 'idx_task_assigned',
            'type' => 'index',
            'fields' => array('assigned_user_id')
        ),
        array(
            'name' => 'idx_task_status',
            'type' => 'index',
            'fields' => array('status')
        ),
        array(
            'name' => 'idx_task_date_due',
            'type' => 'index',
            'fields' => array('date_due')
        ),
    ),
    'duplicate_check' => array(
        'enabled' => false
    ),
    //This enables optimistic locking for Saves From EditView
    'optimistic_locking' => true,
);

VardefManager::createVardef(
    'Tasks',
    'Task',
    array(
        'default',
        'assignable',
        'team_security',
    )
);

//boost value for full text search
$dictionary['Task']['fields']['description']['full_text_search']['boost'] = 0.56;
