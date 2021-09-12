<?php


$module_name = 'J_PaymentDetail';
$viewdefs[$module_name]['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'inv_code' => array(),
        'status' => array(),
        'pos_code' => array(),
        'expired_date' => array(),
        'payment_amount' => array(),
        'kind_of_course' => array(),
        'level' => array(),
        'payment_date' => array(),
        'team_name' => array(),
        'student_name' => array(),
        'assigned_user_name' => array(),
        'payment_method' => array(),
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
        'date_entered' => array(),
        'date_modified' => array(),
    ),
);
