<?php
    $dictionary['C_SiteDeployment'] = array(
        'table' => 'c_sitedeployment',
        'audited' => true,
        'activity_enabled' => false,
        'duplicate_merge' => true,
        'fields' => array(
            'site_url' =>
            array (
                'required' => false,
                'name' => 'site_url',
                'vname' => 'LBL_SITE_URL',
                'type' => 'url',
                'massupdate' => false,
                'no_default' => false,
                'importable' => 'true',
                'duplicate_merge' => 'enabled',
                'duplicate_merge_dom_value' => '1',
                'audited' => false,
                'reportable' => true,
                'unified_search' => false,
                'merge_filter' => 'disabled',
                'pii' => false,
                'default' => 'http://{name}',
                'calculated' => false,
                'len' => '255',
                'size' => '20',
                'dbType' => 'varchar',
                'gen' => '1',
                'link_target' => '_blank',
            ),
            'date_expired_crm' => array(
                'name' => 'date_expired_crm',
                'vname' => 'LBL_DATE_EXPIRED_CRM',
                'type' => 'date',
            ),
            'date_start_crm' => array(
                'name' => 'date_start_crm',
                'vname' => 'LBL_DATE_START_CRM',
                'type' => 'date',
            ),
            'status' => array(
                'name' => 'status',
                'vname' => 'LBL_STATUS',
                'type' => 'enum',
                'len' => '100',
                'options'=>'site_deployment_status_options',
                'default'=>'Running'
            ),
            'git_url' => array(
                'name' => 'git_url',
                'vname' => 'LBL_GIT_URL',
                'type' => 'varchar',
                'len' => 255,
                'required' => true
            ),
            'lic_remain' => array(
                'name' => 'lic_remain',
                'vname' => 'LBL_LIC_REMAIN',
                'type' => 'varchar',
                'dbType' => 'int',
                'len' => 11,
                'required' => false
            ),
            'lic_users_crm' => array(
                'name' => 'lic_users_crm',
                'vname' => 'LBL_LIC_USERS_CRM',
                'type' => 'int',
                'len' => 11,
            ),
            'lic_teams' => array(
                'name' => 'lic_teams',
                'vname' => 'LBL_LIC_TEAMS',
                'type' => 'int',
                'len' => 11,
                'enable_range_search' => true,
            ),
            'lic_students' => array(
                'name' => 'lic_students',
                'vname' => 'LBL_LIC_STUDENTS',
                'type' => 'int',
                'len' => 11,
                'required' => true,
                'enable_range_search' => true,
            ),
            'lic_type' => array(
                'name' => 'lic_type',
                'vname' => 'LBL_LIC_TYPE',
                'type' => 'enum',
                'len' => 100,
                'required' => true,
                'options'=>'license_type_options',
            ),
            'lic_storages' => array(
                'name' => 'lic_storages',
                'vname' => 'LBL_LIC_STORAGES',
                'type' => 'int',
                'len' => 11,
                // 'required' => true,
                'enable_range_search' => true,
            ),
            'db_name' => array(
                'name' => 'db_name',
                'vname' => 'LBL_DB_NAME',
                'type' => 'varchar',
                'len' => 255,
                'readonly' => true,
            ),
            'db_pass' => array(
                'name' => 'db_pass',
                'vname' => 'LBL_DB_PASS',
                'type' => 'varchar',
                'len' => 255,
                'readonly' => true,
            ),
            'user_admin' => array(
                'name' => 'user_admin',
                'vname' => 'LBL_USER_ADMIN',
                'type' => 'varchar',
                'len' => 100,
                'readonly' => true,
            ),
            'pass_admin' => array(
                'name' => 'pass_admin',
                'vname' => 'LBL_PASS_ADMIN',
                'type' => 'varchar',
                'len' => 100,
                'readonly' => true,
            ),
        ),
        'relationships' => array(),
        'optimistic_locking' => true,
        'unified_search' => true,
        'full_text_search' => true,
    );

    if (!class_exists('VardefManager')) {
    }
VardefManager::createVardef('C_SiteDeployment', 'C_SiteDeployment', array('basic', 'team_security', 'assignable', 'taggable'));
