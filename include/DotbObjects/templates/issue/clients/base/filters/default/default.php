<?php


$module_name = '<module_name>';
$_module_name = '<_module_name>';
$viewdefs[$module_name]['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        $_module_name. '_number' => array(),
        'name' => array(),
        'resolution' => array(),
        'status' => array(),
        'priority' => array(),
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
