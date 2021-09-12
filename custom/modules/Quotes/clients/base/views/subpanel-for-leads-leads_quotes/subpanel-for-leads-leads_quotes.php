<?php
// created: 2020-08-04 10:08:04
$viewdefs['Quotes']['base']['view']['subpanel-for-leads-leads_quotes'] = array (
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
                                    'type' => 'event-status'
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
                            5 => 'created_by_name',
                            6 => 'date_modified',
                        ),
                ),
        ),
    'rowactions' =>
        array (
            'actions' =>
                array (
//      0 =>
//      array (
//        'type' => 'actiondropdown',
//        'name' => 'main_dropdown',
//        'primary' => true,
//        'showOn' => 'view',
//        'buttons' =>
//        array (
//          0 =>
//          array (
//            'name' => 'export',
//            'type' => 'rowaction',
//            'css_class' => 'btn',
//            'tooltip' => 'LBL_EXPORT',
//            'event' => 'list:exportrow:fire',
//            'icon' => 'fa-file-export',
//            'acl_action' => 'view',
//          ),
//          1 =>
//          array (
//            'type' => 'rowaction',
//            'name' => 'void',
//            'label' => 'LBL_VOID',
//            'acl_action' => 'view',
//            'event' => 'list:voidInvoice:fire',
//          ),
//        ),
//      ),
                ),
        ),
    'orderBy' =>
        array (
            'field' => 'date_modified',
            'direction' => 'desc',
        ),
  'type' => 'subpanel-list',
);