<?php

$viewdefs['Quotes']['base']['view']['subpanel-list'] = array(
    'panels' =>
    array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' =>
            array(
                array(
                    'label' => 'LBL_LIST_QUOTE_NAME',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'name',
                    'link' => true,
                ),
                array(
                    'target_record_key' => 'account_id',
                    'target_module' => 'Accounts',
                    'label' => 'LBL_LIST_ACCOUNT_NAME',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'account_name',
                    'sortable' => false,
                ),
                array(
                    'label' => 'LBL_LIST_AMOUNT_USDOLLAR',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'total_usdollar',
                    'readonly' => true
                ),
                array(
                    'name' => 'date_quote_expected_closed',
                    'label' => 'LBL_LIST_DATE_QUOTE_EXPECTED_CLOSED',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'target_record_key' => 'assigned_user_id',
                    'target_module' => 'Employees',
                    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => false,
                ),
            ),
        ),
    ),
    // Disable inline edit for now because of INT-197
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'acl_action' => 'edit',
                'event' => 'list:editrow:fire','css_class'=>'btn',
            ),
            array(
                'type' => 'pdfaction',
                'name' => 'download-pdf',
                'label' => 'LBL_PDF_VIEW',
                'action' => 'download',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'unlink-action',
                'icon' => 'fa-unlink',
                'tooltip' => 'LBL_UNLINK_BUTTON', 'css_class'=>'btn',
            ),
        )
    ),
);
