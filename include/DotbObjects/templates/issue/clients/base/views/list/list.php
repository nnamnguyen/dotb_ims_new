<?php

$module_name = '<module_name>';
$_module_name = '<_module_name>';
$viewdefs[$module_name]['base']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => $_module_name . '_number',
                    'label' => 'LBL_NUMBER',
                    'default' => true,
                    'enabled' => true,
                ),
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
                    'label' => 'LBL_ASSIGNED_TO_NAME',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
