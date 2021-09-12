<?php
// created: 2020-09-22 09:43:19
$viewdefs['Quotes']['base']['view']['subpanel-for-contacts-quote_parent'] = array (
    'panels' =>
        array (
            0 =>
                array (
                    'name' => 'panel_header',
                    'label' => 'LBL_PANEL_1',
                    'fields' =>
                        array (
                            0 =>
                                array (
                                    'name' => 'name',
                                    'link' => true,
                                    'default' => true,
                                    'enabled' => true,
                                ),
                            1 =>
                                array (
                                    'name' => 'total',
                                    'default' => true,
                                    'enabled' => true,
                                ),
                            2 =>
                                array (
                                    'name' => 'quote_stage',
                                    'default' => true,
                                    'enabled' => true,
                                    'type' => 'event-status',
                                ),
                            3 =>
                                array (
                                    'name' => 'paid_amount',
                                    'label' => 'LBL_PAID_AMOUNT',
                                    'enabled' => true,
                                    'default' => true,
                                ),
                            4 =>
                                array (
                                    'name' => 'unpaid_amount',
                                    'label' => 'LBL_UNPAID_AMOUNT',
                                    'css_class' => 'text_green',
                                    'enabled' => true,
                                    'default' => true,
                                ),
                            5 =>
                                array (
                                    'name' => 'created_by_name',
                                    'label' => 'LBL_CREATED',
                                    'enabled' => true,
                                    'readonly' => true,
                                    'id' => 'CREATED_BY',
                                    'link' => true,
                                    'default' => true,
                                ),
                            6 =>
                                array (
                                    'name' => 'date_modified',
                                    'label' => 'LBL_DATE_MODIFIED',
                                    'enabled' => true,
                                    'readonly' => true,
                                    'default' => true,
                                ),
                            7 => 'created_by_name',
                            8 => 'date_modified',
                        ),
                ),
        ),
    'rowactions' =>
        array (
            'actions' =>
                array (
                    0 =>
                        array (
                            'type' => 'rowaction',
                            'name' => 'edit_button',
                            'icon' => 'fa-pencil',
                            'label' => 'LBL_EDIT_BUTTON',
                            'acl_action' => 'edit',
                            'event' => 'list:editrow:fire',
                            'css_class' => 'btn',
                        ),
                    1 =>
                        array (
                            'type' => 'pdfaction',
                            'name' => 'download-pdf',
                            'label' => 'LBL_PDF_VIEW',
                            'action' => 'download',
                            'acl_action' => 'view',
                        ),
                    2 =>
                        array (
                            'type' => 'unlink-action',
                            'icon' => 'fa-unlink',
                            'tooltip' => 'LBL_UNLINK_BUTTON',
                            'css_class' => 'btn',
                        ),
                ),
        ),
    'type' => 'subpanel-list',
);