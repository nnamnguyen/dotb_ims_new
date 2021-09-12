<?php

$viewdefs['Quotes']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'quote_num' => array(),
        'quote_type' => array(),
        'quote_stage' => array(),
        'account_name' => array(),
        'total' => array(),
        'date_quote_expected_closed' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'assigned_user_name' => array(),
        'team_name' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
    ),
);
