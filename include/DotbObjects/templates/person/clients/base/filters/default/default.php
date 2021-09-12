<?php


$module_name = '<module_name>';
$viewdefs[$module_name]['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'first_name' => array(),
        'last_name' => array(),
        'address_city' => array(
            'dbFields' => array(
                'primary_address_city',
                'alt_address_city',
            ),
            'vname' => 'LBL_CITY',
            'type' => 'text',
        ),
        'created_by_name' => array(),
        'do_not_call' => array(),
        'email' => array(),
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
