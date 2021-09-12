<?php


$viewdefs['DataPrivacy']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'quicksearch_field' => array('name', 'dataprivacy_number'),
    'quicksearch_priority' => 2,
    'fields' => array(
        'dataprivacy_number' => array(),
        'name' => array(),
        'type' => array(),
        'priority' => array(),
        'status' => array(),
        'requested_by' => array(),
        'source' => array(),
        'date_opened' => array(),
        'date_closed' => array(),
        'date_due' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
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
