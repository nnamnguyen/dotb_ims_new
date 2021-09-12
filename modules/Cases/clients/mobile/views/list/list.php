<?php


$viewdefs['Cases']['mobile']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
		            'label' => 'LBL_SUBJECT',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'status',
		            'label' => 'LBL_STATUS',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'case_number',
                    'label' => 'LBL_NUMBER',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'priority',
                    'label' => 'LBL_PRIORITY',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'resolution',
                    'label' => 'LBL_RESOLUTION',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'team_name',
                    'label' => 'LBL_TEAM',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_ASSIGNED_USER',
                    'default' => true,
                    'enabled' => true,
                ),
            ),
        ),
    ),
);
