<?php

$viewdefs['KBContents']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'status' => array(),
        'language' => array(
            'type' => 'enum-config',
            'key' => 'languages',
        ),
        'category_name' => array(),
        'revision' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        'assigned_user_name' => array(),
        'tag' => array(),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
        'active_date' => array(),
        'exp_date' => array(),
        'is_external' => array(),
        'kbsapprover_name' => array(),
    ),
);
