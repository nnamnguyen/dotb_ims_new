<?php


$dictionary['erased_fields'] = array(
    'table' => 'erased_fields',
    'fields' => array(
        'bean_id' => array(
            'name' => 'bean_id',
            'type' => 'id',
            'required' => true,
        ),
        'table_name' => array(
            'name' => 'table_name',
            'type' => 'varchar',
            'len' => '128',
            'required' => true,
            'isnull' => false,
        ),
        'data' => array(
            'name' => 'data',
            'type' => 'json',
            'dbType' => 'text',
            'required' => true,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_erased_fields_pk',
            'type' => 'primary',
            'fields' => array(
                'bean_id',
                'table_name',
            ),
        ),
    ),
);
