<?php

$viewdefs['DRI_Workflow_Templates']['base']['view']['subpanel-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'available_modules',
                    'label' => 'LBL_AVAILABLE_MODULES',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'related_activities',
                    'label' => 'LBL_RELATED_ACTIVITIES',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'points',
                    'label' => 'LBL_POINTS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_modified',
                ),
            ),
        ),
    ),
    'orderBy' => array(
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
