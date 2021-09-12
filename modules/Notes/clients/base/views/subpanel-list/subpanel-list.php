<?php

$viewdefs['Notes']['base']['view']['subpanel-list'] = array(
    'panels' =>
    array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' =>
            array(
                array(
                    'label' => 'LBL_LIST_SUBJECT',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'name',
                    'link' => true,
                ),
                array(
                    'label' => 'LBL_LIST_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_modified',
                ),
                array(
                    'label' => 'LBL_LIST_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_entered',
                ),
                array(
                    'name' => 'assigned_user_name',
                    'target_record_key' => 'assigned_user_id',
                    'target_module' => 'Employees',
                    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
