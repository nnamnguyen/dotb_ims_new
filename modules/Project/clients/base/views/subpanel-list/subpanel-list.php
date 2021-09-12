<?php

$viewdefs['Project']['base']['view']['subpanel-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'name',
                    'link' => true,
                ),
                array(
                    'target_record_key' => 'assigned_user_id',
                    'target_module' => 'Users',
                    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'assigned_user_name',
                    'sortable' => false,
                ),
                array(
                    'label' => 'LBL_DATE_START',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'estimated_start_date',
                ),
                array(
                    'label' => 'LBL_DATE_END',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'estimated_end_date',
                ),
            ),
        ),
    ),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire','css_class'=>'btn',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'unlink-action',
                'icon' => 'fa-chain-broken',
                'tooltip' => 'LBL_UNLINK_BUTTON', 'css_class'=>'btn',
            ),
        ),
    ),
);
