<?php

$viewdefs['ProspectLists']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields'         => array(
        'name'      => array(),
        'list_type' => array(),
        'tag' => array(),
        '$owner'    => array(
            'predefined_filter' => true,
            'vname'             => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname'             => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
