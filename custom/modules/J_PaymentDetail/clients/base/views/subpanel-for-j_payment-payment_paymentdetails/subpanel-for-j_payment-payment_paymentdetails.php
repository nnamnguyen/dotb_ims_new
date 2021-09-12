<?php
// created: 2020-01-15 02:11:03
$viewdefs['J_PaymentDetail']['base']['view']['subpanel-for-j_payment-payment_paymentdetails'] = array (
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
          'name' => 'invoice_name',
          'label' => 'LBL_INVOICE_NUMBER',
          'enabled' => true,
          'id' => 'INVOICE_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        2 => 
        array (
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'default' => true,
          'name' => 'date_modified',
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