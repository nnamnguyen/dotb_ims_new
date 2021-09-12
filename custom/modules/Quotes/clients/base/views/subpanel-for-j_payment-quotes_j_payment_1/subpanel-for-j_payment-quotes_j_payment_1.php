<?php
// created: 2020-10-27 10:44:00
$viewdefs['Quotes']['base']['view']['subpanel-for-j_payment-quotes_j_payment_1'] = array (
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
          'label' => 'LBL_LIST_QUOTE_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        1 => 
        array (
          'name' => 'total',
          'label' => 'LBL_TOTAL',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'unpaid_amount',
          'label' => 'LBL_UNPAID_AMOUNT',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'paid_amount',
          'label' => 'LBL_PAID_AMOUNT',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
      array (
          'name' => 'use_balance_from_receipt_amount',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
      ),
        array (
          'name' => 'order_date',
          'label' => 'LBL_ORDER_DATE',
          'enabled' => true,
          'default' => true,
        ),
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_ASSIGNED_TO',
          'enabled' => true,
          'id' => 'ASSIGNED_USER_ID',
          'link' => true,
          'default' => true,
        ),
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
        ),
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
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