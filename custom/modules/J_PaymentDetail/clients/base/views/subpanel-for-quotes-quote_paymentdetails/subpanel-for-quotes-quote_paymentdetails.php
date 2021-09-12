<?php
// created: 2020-07-27 15:44:50
$viewdefs['J_PaymentDetail']['base']['view']['subpanel-for-quotes-quote_paymentdetails'] = array (
    'panels' =>
        array(
            0 =>
                array(
                    'name' => 'panel_header',
                    'label' => 'LBL_PANEL_1',
                    'fields' =>
                        array(
                            1 =>
                                array(
                                    'name' => 'name',

                                    'link' => true,

                                ),
                            2 =>
                                array(
                                    'name' => 'payment_amount',
                                    'label' => 'LBL_PAYMENT_AMOUNT',
                                    'enabled' => true,
                                    'default' => true,
                                ),
                            3 =>
                                array(
                                    'name' => 'payment_date',
                                    'label' => 'LBL_PAYMENT_DATE',
                                    'css_class' => 'text_green',
                                    'enabled' => true,
                                    'default' => true,
                                ),
                            5 =>
                                array(
                                    'name' => 'payment_method',
                                    'label' => 'LBL_PAYMENT_METHOD',
                                    'enabled' => true,
                                    'default' => true,
                                ),
                            6 =>
                                array(
                                    'name' => 'status',
                                    'label' => 'LBL_STATUS',
                                    'enabled' => true,
                                    'default' => true,
                                    'type' => 'event-status'
                                ),
                            7 =>
                                array(
                                    'name' => 'description',
                                    'label' => 'LBL_DESCRIPTION',
                                    'enabled' => true,
                                    'sortable' => false,
                                    'default' => true,
                                ),
                            9 =>
                                array(
                                    'name' => 'assigned_user_name',
                                    'label' => 'LBL_ASSIGNED_TO',
                                    'enabled' => true,
                                    'id' => 'ASSIGNED_USER_ID',
                                    'link' => true,
                                    'default' => true,
                                ),
                        ),
                ),
        ),
    'rowactions' =>
        array (
            'actions' =>
                array (
                    0 =>
                        array (
                            'type' => 'fieldset',
                            'name' => 'main_dropdown',
                            'primary' => false,
                            'showOn' => 'view',
                            'fields' =>
                                array (
                                    0=> array (
                                        'name'=>'export',
                                        'type' => 'exportbutton',
                                        'css_class' => 'btn',
                                        'tooltip' => 'LBL_EXPORT',
                                        'event' => 'list:exportrow:fire',
                                        'icon' => 'fa-file-export',
                                        'acl_action' => 'view',
                                        'dismiss_label' => true,

                                    ),
                                    1=> array (
                                        'type' => 'voidbutton',
                                        'name' => 'void',
                                        'label' => 'LBL_VOID',
                                        'tooltip' => 'LBL_VOID',
                                        'acl_action' => 'view',
                                        'event' => 'list:voidInvoice:fire',
                                        'icon' => 'fa-minus-circle',
                                        'css_class' => 'btn',
                                        'dismiss_label' => true,
                                    ),
                                    2 =>
                                        array(
                                            'type' => 'paidbutton',
                                            'name' => 'paid_button',
                                            'label' => 'LBL_PAY',
                                            'icon' => 'fa-hand-holding-usd',
                                            'tooltip' => 'LBL_PAY',
                                            'acl_action' => 'edit',
                                            'event' => 'list:paidInvoice:fire',
                                            'css_class' => 'btn',
                                        ),
                                ),
                        ),
                ),
        ),
    'orderBy' =>
        array(
            'field' => 'date_modified',
            'direction' => 'desc',
        ),
    'type' => 'subpanel-list',
);