<?php


$module_name = 'J_Discount';
$viewdefs[$module_name]['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'order_no' => array(),
        'name' => array(),
        'status' => array(),
        'type' => array(),
        'category' => array(),
        'discount_percent' => array(),
        'discount_amount' => array(),
        'policy' => array(),
        'team_name' => array(),
        'date_modified' => array(),
        'date_entered' => array(),
        'assigned_user_name' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
        'created_by_name' => array(),
        'modified_by_name' => array(),
    ),
);
