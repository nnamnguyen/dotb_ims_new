<?php


$dictionary['key_value_cache'] = array(
    'table' => 'key_value_cache',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'char',
            'len' => '32',
            'required' => true,
        ),
        'date_expires' => array(
            'name' => 'date_expires',
            'type' => 'datetime',
            'default' => null,
            'required' => true,
        ),
        'value' => array(
            'name' => 'value',
            'type' => 'longtext',
            'default' => null,
            'required' => false,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'key_value_cache_name',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'key_value_cache_date_expires',
            'type' => 'index',
            'fields' => array(
                'date_expires',
            ),
        ),
    ),
);
