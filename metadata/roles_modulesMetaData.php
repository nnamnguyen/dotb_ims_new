<?php


$dictionary['roles_modules'] = array(
    'table' => 'roles_modules',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'role_id' => array(
            'name' => 'role_id',
            'type' => 'id',
        ),
        'module_id' => array(
            'name' => 'module_id',
            'type' => 'id',
        ),
        'allow' => array(
            'name' => 'allow',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
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
        ),
    ),
    'indices' => array(
        array(
            'name' => 'roles_modulespk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_role_id',
            'type' => 'index',
            'fields' => array(
                'role_id',
            ),
        ),
        array(
            'name' => 'idx_module_id',
            'type' => 'index',
            'fields' => array(
                'module_id',
            ),
        ),
    ),
);
