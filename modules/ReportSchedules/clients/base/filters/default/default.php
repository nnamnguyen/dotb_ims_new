<?php


$viewdefs['ReportSchedules']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'report_name' => array(),
        'time_interval' => array(),
        'active' => array(),
        'assigned_user_name' => array(),
        'created_by_name' => array(),
        'modified_by_name' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
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
