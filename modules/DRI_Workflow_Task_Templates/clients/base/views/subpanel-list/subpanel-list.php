<?php

$viewdefs['DRI_Workflow_Task_Templates']['base']['view']['subpanel-list'] = array (
    'panels' => array (
        array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'label' => 'LBL_NAME',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                    'name' => 'name',
                ),
                array (
                    'name' => 'sort_order',
                    'label' => 'LBL_SORT_ORDER',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'points',
                    'label' => 'LBL_POINTS',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'activity_type',
                    'label' => 'LBL_ACTIVITY_TYPE',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'type',
                    'label' => 'LBL_TYPE',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
    'orderBy' => array (
        'field' => 'sort_order',
        'direction' => 'asc',
    ),
);
