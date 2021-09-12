<?php


$viewdefs['Teams']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_PRIMARY_TEAM_NAME',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'description',
                    'label' => 'LBL_DESCRIPTION',
                    'sortable' => false,
                ),
                array(
                    'name' => 'private',
                    'label' => 'LBL_PRIVATE',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
            ),

        ),
    ),
);
