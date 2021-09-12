<?php
// created: 2020-11-09 10:18:01
$viewdefs['J_PaymentDetail']['base']['view']['subpanel-for-accounts-paymentdetail_parent'] = array (
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
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        1 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
            'type' => 'event-status'
        ),
        2 => 
        array (
          'name' => 'payment_amount',
          'label' => 'LBL_PAYMENT_AMOUNT',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'payment_type',
          'label' => 'LBL_PAYMENT_TYPE',
          'enabled' => true,
          'default' => true,
            'type' => 'event-status'
        ),
        4 => 
        array (
          'name' => 'payment_date',
          'label' => 'LBL_PAYMENT_DATE',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'quote_name',
          'label' => 'LBL_QUOTE_NAME',
          'enabled' => true,
          'id' => 'QUOTE_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'description',
          'label' => 'LBL_DESCRIPTION',
          'enabled' => true,
          'sortable' => false,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        9 => 
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'readonly' => true,
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
                                ),
                        ),
                ),
        ),
  'orderBy' => 
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
);