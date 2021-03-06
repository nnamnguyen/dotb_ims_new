<?php


$dictionary['forecast_tree'] = array(
    'table' => 'forecast_tree',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'required' => true,
        ),
        'name' => array(
            'name' => 'name',
            'type' => 'varchar',
            'len' => 50,
            'required' => true,
        ),
        'hierarchy_type' => array(
            'name' => 'hierarchy_type',
            'type' => 'varchar',
            'len' => 25,
            'required' => true,
        ),
        'user_id' => array(
            'name' => 'user_id',
            'type' => 'id',
            'default' => null,
            'required' => false,
        ),
        'parent_id' => array(
            'name' => 'parent_id',
            'type' => 'id',
            'default' => null,
            'required' => false,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'forecast_tree_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'forecast_tree_idx_user_id',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
    ),
);
