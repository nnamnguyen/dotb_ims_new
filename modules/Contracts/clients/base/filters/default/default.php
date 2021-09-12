<?php


$viewdefs['Contracts']['base']['filter']['default'] = array (
    'default_filter' => 'all_records',
    'fields' =>
    array (
        'name' => array (),
        'type' => array (),
        'account_name' => array ('dbFields' => array (),),
        'start_date' => array (),
        'end_date' => array (),
        'tag' => array(),
        'status' => array (),
        'assigned_user_name' => array (),
        '$owner' => array ('predefined_filter' => true, 'vname' => 'LBL_CURRENT_USER_FILTER',),
        '$favorite' => array ('predefined_filter' => true, 'vname' => 'LBL_FAVORITES_FILTER',),
    ),
);
