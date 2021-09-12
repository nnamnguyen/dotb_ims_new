<?php

$viewdefs['RevenueLineItems']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'opportunity_name' => array(),
        'account_name' => array(),
        'sales_stage' => array(),
        'probability' => array(),
        'date_closed' => array(),
        'commit_stage' => array(),
        'product_template_name' => array(),
        'category_name' => array(),
        'worst_case' => array(),
        'likely_case' => array(),
        'best_case' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'tag' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        'assigned_user_name' => array(),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),

    ),
);
