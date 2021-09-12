<?php

$viewdefs['Dashboards']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'link' => true,
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                    'width' => 'xlarge',
                ),
                array (
                    'name' => 'dashboard_module',
                    'label' => 'LBL_MODULE',
                    'default' => true,
                    'enabled' => true,
                    'readonly' => true,
                ),
                array (
                    'name' => 'view_name',
                    'label' => 'LBL_VIEW',
                    'default' => true,
                    'enabled' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'default_dashboard',
                    'label' => 'LBL_DEFAULT_DASHBOARD',
                    'default' => true,
                    'enabled' => true,
                ),
                array (
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_USER',
                    'id' => 'ASSIGNED_USER_ID',
                    'enabled' => true,
                    'default' => true,
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
