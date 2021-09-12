<?php


$dictionary['tasks_users'] = array(
    'table' => 'tasks_users',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'len' => '36',
        ),
        'task_id' => array(
            'name' => 'task_id',
            'type' => 'id',
            'len' => '36',
        ),
        'user_id' => array(
            'name' => 'user_id',
            'type' => 'id',
            'len' => '36',
        ),
        'required' => array(
            'name' => 'required',
            'type' => 'varchar',
            'len' => '1',
            'default' => '1',
        ),
        'accept_status' => array(
            'name' => 'accept_status',
            'type' => 'varchar',
            'len' => '25',
            'default' => 'none',
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
            'name' => 'tasks_userspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_usr_task_task',
            'type' => 'index',
            'fields' => array(
                'task_id',
            ),
        ),
        array(
            'name' => 'idx_usr_task_usr',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_task_users',
            'type' => 'alternate_key',
            'fields' => array(
                'task_id',
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_task_users_del',
            'type' => 'alternate_key',
            'fields' => array(
                'task_id',
                'user_id',
                'deleted',
            ),
        ),
    ),
    'relationships' => array(
        'tasks_users' => array(
            'lhs_module' => 'tasks',
            'lhs_table' => 'tasks',
            'lhs_key' => 'id',
            'rhs_module' => 'Users',
            'rhs_table' => 'users',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'tasks_users',
            'join_key_lhs' => 'task_id',
            'join_key_rhs' => 'user_id',
        ),
    ),
);
