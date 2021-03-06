<?php


$dictionary['reportschedules_users'] = array(
    'table' => 'reportschedules_users',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'len' => '36',
        ),
        'reportschedule_id' => array(
            'name' => 'reportschedule_id',
            'type' => 'id',
            'len' => '36',
        ),
        'user_id' => array(
            'name' => 'user_id',
            'type' => 'id',
            'len' => '36',
        ),
        'date_modified' => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' => array(
            'name' => 'deleted',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
            'required' => false,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'reportschedules_userspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_usr_rs_rs',
            'type' => 'index',
            'fields' => array(
                'reportschedule_id',
            ),
        ),
        array(
            'name' => 'idx_usr_rs_usr',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_rs_users',
            'type' => 'alternate_key',
            'fields' => array(
                'reportschedule_id',
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_reportschedule_users_del',
            'type' => 'alternate_key',
            'fields' => array(
                'reportschedule_id',
                'user_id',
                'deleted',
            ),
        ),
    ),
    'relationships' => array(
        'reportschedules_users' => array(
            'lhs_module' => 'ReportSchedules',
            'lhs_table' => 'report_schedules',
            'lhs_key' => 'id',
            'rhs_module' => 'Users',
            'rhs_table' => 'users',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'reportschedules_users',
            'join_key_lhs' => 'reportschedule_id',
            'join_key_rhs' => 'user_id',
        ),
    ),
);
