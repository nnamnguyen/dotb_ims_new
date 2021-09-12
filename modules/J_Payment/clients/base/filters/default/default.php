<?php


$module_name = 'J_Payment';
$viewdefs[$module_name]['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'tag' => array(),
        'assigned_user_name' => array(),
        'contacts_j_payment_1_name' => array(),
        'payment_type' => array(),
        'payment_amount' => array(),
        'remain_amount' => array(),
        'remain_hours' => array(),
        'payment_date' => array(),
        'phone' => array(),
        'sale_type' => array(),
        'team_name' => array(),
        'date_modified' => array(),
        'related_payment_detail' => array(),
        'date_entered' => array(),
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
