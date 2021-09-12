<?php

$viewdefs['Calls']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'status' => array(),
        'date_start' => array(),
        'date_end' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'assigned_user_name' => array(),
        'team_name' => array(),
        'tag' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
