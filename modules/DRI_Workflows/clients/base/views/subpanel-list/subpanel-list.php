<?php

$viewdefs['DRI_Workflows']['base']['view']['subpanel-list'] = array (
    'panels' => array (
        array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'name',
                    'link' => true,
                    'type' => 'name',
                ),
                array (
                    'label' => 'LBL_STATE',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'state',
                    'type' => 'enum',
                ),
                array (
                    'label' => 'LBL_PROGRESS',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'progress',
                    'type' => 'cj_progress_bar',
                ),
                array (
                    'label' => 'LBL_DATE_ENTERED',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'date_entered',
                    'type' => 'datetime',
                ),
                array (
                    'label' => 'LBL_DATE_MODIFIED',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'date_modified',
                    'type' => 'datetime',
                ),
            ),
        ),
    ),
    'orderBy' => array (
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
    'type' => 'subpanel-list',
);
