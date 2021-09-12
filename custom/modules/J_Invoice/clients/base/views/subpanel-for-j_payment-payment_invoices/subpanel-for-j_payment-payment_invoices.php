<?php
// created: 2019-04-04 00:39:35
$viewdefs['J_Invoice']['base']['view']['subpanel-for-j_payment-payment_invoices'] = array (
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
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
        ),
        1 => 
        array (
          'name' => 'serial_no',
          'label' => 'LBL_SERIAL_NO',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'invoice_date',
          'label' => 'LBL_INVOICE_DATE',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'before_discount',
          'label' => 'LBL_BEFORE_DISCOUNT',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'total_discount_amount',
          'label' => 'LBL_DISCOUNT_AMOUNT',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'invoice_amount',
          'label' => 'LBL_INVOICE_AMOUNT',
          'enabled' => true,
          'currency_format' => true,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'content_vat_invoice',
          'label' => 'LBL_CONTENT_VAT_INVOICE',
          'enabled' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_ASSIGNED_TO',
          'enabled' => true,
          'id' => 'ASSIGNED_USER_ID',
          'link' => true,
          'default' => true,
        ),
        9 => 
        array (
          'name' => 'custom_button',
          'label' => 'Button',
          'enabled' => true,
          'default' => true,
          'width' => 'xxsmall',
        ),
      ),
    ),
  ),
  'type' => 'subpanel-list',
);