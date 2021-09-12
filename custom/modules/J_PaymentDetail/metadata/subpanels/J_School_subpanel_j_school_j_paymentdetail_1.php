<?php
// created: 2018-08-16 05:34:33
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '10%',
    'default' => true,
  ),
  'subject' => 
  array (
    'type' => 'varchar',
    'widget_class' => 'SubPanelDetailViewLink',
    'vname' => 'LBL_SUBJECT',
    'width' => '10%',
    'default' => true,
  ),
  'receipt_type' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_RECEIPT_TYPE',
    'width' => '10%',
  ),
  'parent_name' => 
  array (
    'type' => 'parent',
    'studio' => 'visible',
    'vname' => 'LBL_PARENT_NAME',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => 'parent_id',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'remind_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_REMIND_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'payment_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_PAYMENT_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'amount_bef_exchange' => 
  array (
    'type' => 'currency',
    'default' => true,
    'studio' => true,
    'vname' => 'LBL_AMOUNT_BEFORE_EXCHANGE',
    'currency_format' => true,
    'width' => '5%',
  ),
  'currency_unit' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'default' => true,
    'vname' => 'LBL_CURRENCY_UNIT',
    'width' => '5%',
  ),
  'exchange_rate' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_EXCHANGE_RATE',
    'width' => '5%',
    'currency_format' => true,
  ),
  'payment_amount' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_PAYMENT_AMOUNT',
    'currency_format' => true,
    'width' => '5%',
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'vname' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'assigned_user_id',
  ),
  'custom_button' => 
  array (
    'type' => 'varchar',
    'width' => '20%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'J_PaymentDetail',
    'width' => '4%',
    'default' => true,
  ),
);