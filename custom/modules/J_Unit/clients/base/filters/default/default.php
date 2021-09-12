<?php
// created: 2019-04-11 08:34:11
//Modified by Tuan Anh
$viewdefs['J_Unit']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' =>
        array(
            'group_unit_name' => array(),
            'team_name' => array(),
            'assigned_user_name' => array(),
            //End Nhom 2
            '$owner' => array(
                'predefined_filter' => true,
                'vname' => 'LBL_CURRENT_USER_FILTER',
            ),
            '$favorite' => array(
                'predefined_filter' => true,
                'vname' => 'LBL_FAVORITES_FILTER',
            ),
        ),
    'quicksearch_field' => array(
    ),
    'quicksearch_priority' => 2,
);