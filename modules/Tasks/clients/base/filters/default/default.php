<?php


$viewdefs['Tasks']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'contact_name' => array(),
        'parent_name' => array(),
        'status' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'date_start' => array(),
        'date_due' => array(),
        'tag' => array(),
        'assigned_user_name' => array(),
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
