<?php


    $dictionary['Case'] = array(
        'table' => 'cases',
        'audited' => true,
        'activity_enabled' => true,
        'unified_search' => true,
        'full_text_search' => true,
        'unified_search_default_enabled' => true,
        'duplicate_merge' => true,
        'comment' => 'Cases are issues or problems that a customer asks a support representative to resolve',
        'fields' => array(
            'parent_type' => array(
                'name' => 'parent_type',
                'vname' => 'LBL_PARENT_NAME',
                'type' => 'parent_type',
                'dbType' => 'varchar',
                'group' => 'parent_name',
                'options' => 'parent_type_case',
                'required' => false,
                'len' => '100',
                'studio' => array('wirelesslistview' => false),
                'options' => 'parent_type_display',
            ),
            'rate' => array(
                'name' => 'rate',
                'vname' => 'LBL_RATE',
                'type' => 'enum',
                'required' => false,
                'reportable' => true,
                'readonly' => true,
                'options' => 'rate_case_list',
                'dbType' => 'int',
            ),
            'parent_name' => array(
                'name' => 'parent_name',
                'parent_type' => 'record_type_display',
                'type_name' => 'parent_type',
                'id_name' => 'account_id',
                'vname' => 'LBL_PARENT_NAME',
                'type' => 'parent',
                'group' => 'parent_name',
                'source' => 'non-db',
                'options' => 'parent_type_case',
                'studio' => true,
                'required' => true,
            ),
            'account_id' => array(
                'name' => 'account_id',
                'type' => 'relate',
                'dbType' => 'id',
                'rname' => 'id',
                'group' => 'parent_name',
                'reportable' => false,
                'vname' => 'LBL_PARENT_ID',
                'reportable' => false,
                'audited' => true,
                'massupdate' => false,
                'required' => true
            ),

            'account_name' => array(
                'name' => 'account_name',
                'rname' => 'name',
                'id_name' => 'account_id',
                'vname' => 'LBL_ACCOUNT_NAME',
                'type' => 'relate',
                'link' => 'accounts',
                'table' => 'accounts',
                'join_name' => 'accounts',
                'isnull' => 'true',
                'module' => 'Accounts',
                'dbType' => 'varchar',
                'len' => 100,
                'source' => 'non-db',
                'unified_search' => true,
                'comment' => 'The name of the account represented by the account_id field',
                'required' => true,
                'importable' => 'required',
                'exportable' => true,
                'studio' => array(
                    'portalrecordview' => false,
                    'portallistview' => false,
                ),
            ),

            //Parent case - Right Side (n) - By Lap Nguyen
            'parent_case_id' => array(
                'name' => 'parent_case_id',
                'vname' => 'LBL_PARENT_CASE',
                'type' => 'id',
                'required'=>false,
                'reportable'=>false,
                'source' => 'db',
            ),
            'parent_case_name' => array(
                'name' => 'parent_case_name',
                'rname' => 'name',
                'id_name' => 'parent_case_id',
                'vname' => 'LBL_PARENT_CASE',
                'type' => 'relate',
                'link' => 'parent_cases_lef',
                'table' => 'cases',
                'isnull' => 'true',
                'module' => 'Cases',
                'dbType' => 'varchar',
                'len' => 'id',
                'reportable'=>true,
                'source' => 'non-db',

            ),
            'parent_cases_lef' => array(
                'name' => 'parent_cases_lef',
                'type' => 'link',
                'relationship' => 'parent_cases',
                'link_type' => 'one',
                'side' => 'right',
                'source' => 'non-db',
                'vname' => 'LBL_PARENT_CASE',
            ),
            //END: Parent Team

            //Customize Relationship
            'parent_cases_rig' => array(
                'name' => 'parent_cases_rig',
                'type' => 'link',
                'relationship' => 'parent_cases',
                'source' => 'non-db',
                'vname' => 'LBL_CHILD_CASE',
            ),

            'source' => array(
                'name' => 'source',
                'vname' => 'LBL_SOURCE',
                'type' => 'enum',
                'options' => 'source_dom',
                'len' => 255,
                'comment' => 'An indicator of how the bug was entered (ex: via web, email, etc.)',
                'required' => true,
            ),
            'status' => array(
                'name' => 'status',
                'vname' => 'LBL_STATUS',
                'type' => 'enum',
                'options' => 'case_status_dom',
                'len' => 100,
                'audited' => true,
                'comment' => 'The status of the case',
                'merge_filter' => 'enabled',
                'sortable' => true,
                'required' => true,
            ),
            'last_comment_direction' => array(
                'name' => 'last_comment_direction',
                'vname' => 'LBL_LAST_COMMENT_DIRECTION',
                'type' => 'enum',
                'options' => 'comments_direction_options',
                'len' => 100,
                'default' => 'inbound',
            ),
            'last_comment_date' => array(
                'name' => 'last_comment_date',
                'vname' => 'LAST_COMMENT_DATE',
                'type' => 'datetime',
            ),
            'last_comment' => array(
                'name' => 'last_comment',
                'vname' => 'LBL_LAST_COMMENT',
                'type' => 'varchar',
                'len' => 255,
                'source' => 'non-db',
            ),
            'count_comment' => array(
                'name' => 'count_comment',
                'vname' => 'LBL_COUNT_COMMENT',
                'type' => 'int'
            ),
            'priority' => array(
                'name' => 'priority',
                'vname' => 'LBL_PRIORITY',
                'type' => 'enum',
                'options' => 'case_priority_dom',
                'len' => 100,
                'audited' => true,
                'comment' => 'The priority of the case',
                'merge_filter' => 'enabled',
                'sortable' => true,
            ),
            'resolution' => array(
                'name' => 'resolution',
                'vname' => 'LBL_RESOLUTION',
                'type' => 'text',
                'full_text_search' => array(
                    'enabled' => true,
                    'searchable' => true,
                    'boost' => 0.65,
                ),
                'comment' => 'The resolution of the case',
            ),
            'portal_viewable' => array(
                'name' => 'portal_viewable',
                'vname' => 'LBL_SHOW_IN_PORTAL',
                'type' => 'bool',
                'default' => 0,
                'reportable' => false,
            ),
            'tasks' => array(
                'name' => 'tasks',
                'type' => 'link',
                'relationship' => 'case_tasks',
                'source' => 'non-db',
                'vname' => 'LBL_TASKS',
            ),
            'notes' => array(
                'name' => 'notes',
                'type' => 'link',
                'relationship' => 'case_notes',
                'source' => 'non-db',
                'vname' => 'LBL_NOTES',
            ),
            'meetings' => array(
                'name' => 'meetings',
                'type' => 'link',
                'relationship' => 'case_meetings',
                'bean_name' => 'Meeting',
                'source' => 'non-db',
                'vname' => 'LBL_MEETINGS',
            ),
            'emails' => array(
                'name' => 'emails',
                'type' => 'link',
                'relationship' => 'emails_cases_rel',
                'source' => 'non-db',
                'vname' => 'LBL_EMAILS',
            ),
            'archived_emails' => array(
                'name' => 'archived_emails',
                'type' => 'link',
                'link_file' => 'modules/Cases/CaseEmailsLink.php',
                'link_class' => 'CaseEmailsLink',
                'link' => 'contacts',
                'module' => 'Emails',
                'source' => 'non-db',
                'vname' => 'LBL_EMAILS',
                'link_type' => 'many',
                'relationship' => '',
                'hideacl' => true,
                'readonly' => true,
            ),
            'documents' => array(
                'name' => 'documents',
                'type' => 'link',
                'relationship' => 'documents_cases',
                'source' => 'non-db',
                'vname' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
            ),
            'calls' => array(
                'name' => 'calls',
                'type' => 'link',
                'relationship' => 'case_calls',
                'source' => 'non-db',
                'vname' => 'LBL_CALLS',
            ),
            'bugs' => array(
                'name' => 'bugs',
                'type' => 'link',
                'relationship' => 'cases_bugs',
                'source' => 'non-db',
                'vname' => 'LBL_BUGS',
            ),
            'contacts' => array(
                'name' => 'contacts',
                'type' => 'link',
                'relationship' => 'contacts_cases',
                'source' => 'non-db',
                'vname' => 'LBL_CONTACTS',
            ),
            'accounts' => array(
                'name' => 'accounts',
                'type' => 'link',
                'relationship' => 'account_cases',
                'link_type' => 'one',
                'side' => 'right',
                'source' => 'non-db',
                'vname' => 'LBL_ACCOUNT',
            ),
            'project' => array(
                'name' => 'project',
                'type' => 'link',
                'relationship' => 'projects_cases',
                'source' => 'non-db',
                'vname' => 'LBL_PROJECTS',
            ),
            'kbcontents' => array(
                'name' => 'kbcontents',
                'type' => 'link',
                'vname' => 'LBL_KBCONTENTS_SUBPANEL_TITLE',
                'relationship' => 'relcases_kbcontents',
                'source' => 'non-db',
                'link_type' => 'many',
                'side' => 'right',
            ),
        ),
        'indices' => array(
            array(
                'name' => 'idx_case_name',
                'type' => 'index',
                'fields' => array(
                    'name',
                ),
            ),
            array(
                'name' => 'idx_account_id',
                'type' => 'index',
                'fields' => array(
                    'account_id',
                ),
            ),
            array(
                'name' => 'idx_cases_stat_del',
                'type' => 'index',
                'fields' => array(
                    'assigned_user_id',
                    'status',
                    'deleted',
                ),
            ),
        ),
        'relationships' => array(
            'case_calls' => array(
                'lhs_module' => 'Cases',
                'lhs_table' => 'cases',
                'lhs_key' => 'id',
                'rhs_module' => 'Calls',
                'rhs_table' => 'calls',
                'rhs_key' => 'parent_id',
                'relationship_type' => 'one-to-many',
                'relationship_role_column' => 'parent_type',
                'relationship_role_column_value' => 'Cases',
            ),
            'case_tasks' => array(
                'lhs_module' => 'Cases',
                'lhs_table' => 'cases',
                'lhs_key' => 'id',
                'rhs_module' => 'Tasks',
                'rhs_table' => 'tasks',
                'rhs_key' => 'parent_id',
                'relationship_type' => 'one-to-many',
                'relationship_role_column' => 'parent_type',
                'relationship_role_column_value' => 'Cases',
            ),
            'case_notes' => array(
                'lhs_module' => 'Cases',
                'lhs_table' => 'cases',
                'lhs_key' => 'id',
                'rhs_module' => 'Notes',
                'rhs_table' => 'notes',
                'rhs_key' => 'parent_id',
                'relationship_type' => 'one-to-many',
                'relationship_role_column' => 'parent_type',
                'relationship_role_column_value' => 'Cases',
            ),
            'case_meetings' => array(
                'lhs_module' => 'Cases',
                'lhs_table' => 'cases',
                'lhs_key' => 'id',
                'rhs_module' => 'Meetings',
                'rhs_table' => 'meetings',
                'rhs_key' => 'parent_id',
                'relationship_type' => 'one-to-many',
                'relationship_role_column' => 'parent_type',
                'relationship_role_column_value' => 'Cases',
            ),
            'case_emails' => array(
                'lhs_module' => 'Cases',
                'lhs_table' => 'cases',
                'lhs_key' => 'id',
                'rhs_module' => 'Emails',
                'rhs_table' => 'emails',
                'rhs_key' => 'parent_id',
                'relationship_type' => 'one-to-many',
                'relationship_role_column' => 'parent_type',
                'relationship_role_column_value' => 'Cases',
            ),
            'cases_assigned_user' => array(
                'lhs_module' => 'Users',
                'lhs_table' => 'users',
                'lhs_key' => 'id',
                'rhs_module' => 'Cases',
                'rhs_table' => 'cases',
                'rhs_key' => 'assigned_user_id',
                'relationship_type' => 'one-to-many',
            ),
            'cases_modified_user' => array(
                'lhs_module' => 'Users',
                'lhs_table' => 'users',
                'lhs_key' => 'id',
                'rhs_module' => 'Cases',
                'rhs_table' => 'cases',
                'rhs_key' => 'modified_user_id',
                'relationship_type' => 'one-to-many',
            ),
            'cases_created_by' => array(
                'lhs_module' => 'Users',
                'lhs_table' => 'users',
                'lhs_key' => 'id',
                'rhs_module' => 'Cases',
                'rhs_table' => 'cases',
                'rhs_key' => 'created_by',
                'relationship_type' => 'one-to-many',
            ),
            //Custom relationship Case related
            'parent_cases' => array(
                'lhs_module' => 'Cases',
                'lhs_table' => 'cases',
                'lhs_key' => 'id',
                'rhs_module' => 'Cases',
                'rhs_table' => 'cases',
                'rhs_key' => 'parent_case_id',
                'relationship_type' => 'one-to-many'
            ),
        ),
        'acls' => array(
            'DotbACLStatic' => true,
        ),
//        'duplicate_check' => array(
//            'enabled' => true,
//            'FilterDuplicateCheck' => array(
//                'filter_template' => array(
//                    array(
//                        '$and' => array(
//                            array(
//                                'name' => array(
//                                    '$starts' => '$name',
//                                ),
//                            ),
//                            array(
//                                'status' => array(
//                                    '$not_equals' => 'Closed',
//                                ),
//                            ),
//                            array(
//                                'account_id' => array(
//                                    '$equals' => '$account_id',
//                                ),
//                            ),
//                        ),
//                    ),
//                ),
//                'ranking_fields' => array(
//                    array(
//                        'in_field_name' => 'name',
//                        'dupe_field_name' => 'name',
//                    ),
//                    array(
//                        'in_field_name' => 'account_id',
//                        'dupe_field_name' => 'account_id',
//                    ),
//                ),
//            ),
//        ),

        // This enables optimistic locking for Saves From EditView
        'optimistic_locking' => true,
    );

    VardefManager::createVardef('Cases', 'Case', array(
        'default',
        'assignable',
        'team_security',
        'issue',
        ), 'case');

    //jc - adding for refactor for import to not use the required_fields array
    //defined in the field_arrays.php file
    $dictionary['Case']['fields']['name']['importable'] = 'required';

    //boost value for full text search
    $dictionary['Case']['fields']['name']['full_text_search']['boost'] = 1.53;
    $dictionary['Case']['fields']['case_number']['full_text_search']['boost'] = 1.29;
    $dictionary['Case']['fields']['description']['full_text_search']['boost'] = 0.66;
    $dictionary['Case']['fields']['work_log']['full_text_search']['boost'] = 0.64;
