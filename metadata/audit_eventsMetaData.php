<?php

$dictionary['audit_events'] = array(
    'table' => 'audit_events',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'required' => true,
        ),
        'type' => array(
              'name' => 'type',
              'type' => 'char',
              'len' => 10,
              'required' => true,
        ),
        'parent_id' => array(
              'name' => 'parent_id',
              'type' => 'id',
              'required' => true,
        ),
        'module_name' => array(
            'name' => 'module_name',
            'type' => 'varchar',
            'len' => 100,
            'required' => true,
        ),
        'source' => array(
            'name' => 'source',
            'type' => 'json',
            'dbType' => 'text',
            'required' => false,
        ),
        'date_created' => array(
            'name' => 'date_created',
            'type' => 'datetime',
            'required' => true,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_aud_eve_id',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_aud_eve_ptd',
            'type' => 'index',
            'fields' => array(
                'parent_id',
                'type',
                'date_created',
            ),
        ),
    ),
);
