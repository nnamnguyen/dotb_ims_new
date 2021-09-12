<?php
// created: 2020-08-04 10:08:03
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_QUOTE_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'quote_type' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_QUOTE_TYPE',
    'width' => 10,
    'default' => true,
  ),
  'total' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_TOTAL',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => 10,
    'default' => true,
  ),
  'paid_amount' => 
  array (
    'type' => 'currency',
    'studio' => 'visible',
    'default' => true,
    'vname' => 'LBL_PAID_AMOUNT',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => 10,
  ),
  'unpaid_amount' => 
  array (
    'type' => 'currency',
    'studio' => 'visible',
    'default' => true,
    'vname' => 'LBL_UNPAID_AMOUNT',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => 10,
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'vname' => 'LBL_DATE_ENTERED',
    'width' => 10,
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'name' => 'assigned_user_name',
    'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'assigned_user_id',
    'target_module' => 'Employees',
    'width' => 10,
    'default' => true,
  ),
  'currency_id' => 
  array (
    'usage' => 'query_only',
  ),
);