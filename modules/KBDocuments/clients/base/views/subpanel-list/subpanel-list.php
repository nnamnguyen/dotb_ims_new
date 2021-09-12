<?php

$viewdefs['KBDocuments']['base']['view']['subpanel-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'kbdocument_name',
                    'label' => 'LBL_LIST_DOCUMENT_NAME',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'status_id',
                    'label' => 'LBL_LIST_STATUS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'kbdoc_approver_name',
                    'target_record_key' => 'kbdoc_approver_id',
                    'target_module' => 'Users',
                    'label' => 'LBL_LIST_APPROVED_BY',
                    'enabled' => true,
                    'type' => 'relate',
                    'default' => true,
                ),
                array(
                    'name'  => 'date_modified',
                    'label' => 'LBL_DATE_MODIFIED',
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
                'css_class' => 'btn',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
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
