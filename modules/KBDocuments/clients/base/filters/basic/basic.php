<?php

$viewdefs['KBDocuments']['base']['filter']['basic'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'status' => array(),
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
