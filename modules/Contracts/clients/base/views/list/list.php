<?php

$viewdefs['Contracts']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_LIST_CONTRACT_NAME',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'account_name',
                    'label' => 'LBL_LIST_ACCOUNT_NAME',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                    'link' => false,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'start_date',
                    'label' => 'LBL_LIST_START_DATE',
                    'link' => false,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'end_date',
                    'label' => 'LBL_LIST_END_DATE',
                    'link' => false,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'team_name',
                    'label' => 'LBL_LIST_TEAM',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_TO_USER',
                    'default' => true,
                    'enabled' => true,
                ),
            ),
        ),
    ),
);
