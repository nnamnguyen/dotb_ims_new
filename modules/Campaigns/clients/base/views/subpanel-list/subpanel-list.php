<?php

$viewdefs['Campaigns']['base']['view']['subpanel-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_LIST_CAMPAIGN_NAME',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_LIST_STATUS',
                    'enabled' => true,
                    'default' => true,
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
