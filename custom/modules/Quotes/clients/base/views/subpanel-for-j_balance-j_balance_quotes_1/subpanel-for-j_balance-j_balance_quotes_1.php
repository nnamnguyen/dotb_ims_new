<?php
// created: 2020-09-17 10:26:41
$viewdefs['Quotes']['base']['view']['subpanel-for-j_balance-j_balance_quotes_1'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
        array (
          'label' => 'LBL_LIST_QUOTE_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
            'name'=>'total_amount_relata_balance',
            'type' => 'currency',
        ),
        array (
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
  'rowactions' => 
  array (
    'actions' => 
    array (
//      0 =>
//      array (
//        'type' => 'rowaction',
//        'name' => 'edit_button',
//        'icon' => 'fa-pencil',
//        'label' => 'LBL_EDIT_BUTTON',
//        'acl_action' => 'edit',
//        'event' => 'list:editrow:fire',
//        'css_class' => 'btn',
//      ),
//      1 =>
//      array (
//        'type' => 'pdfaction',
//        'name' => 'download-pdf',
//        'label' => 'LBL_PDF_VIEW',
//        'action' => 'download',
//        'acl_action' => 'view',
//      ),
//      2 =>
//      array (
//        'type' => 'unlink-action',
//        'icon' => 'fa-unlink',
//        'tooltip' => 'LBL_UNLINK_BUTTON',
//        'css_class' => 'btn',
//      ),
    ),
  ),
  'type' => 'subpanel-list',
);