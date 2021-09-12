<?php

$module_name = 'DRI_Workflow_Task_Templates';
$viewdefs[$module_name]['mobile']['view']['list'] = array (
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array (
                array (
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array (
                    'name' => 'team_name',
                    'label' => 'LBL_TEAM',
                    'width' => 9,
                    'default' => true,
                    'enabled' => true,
                ),
            ),
        ),
    ),
);