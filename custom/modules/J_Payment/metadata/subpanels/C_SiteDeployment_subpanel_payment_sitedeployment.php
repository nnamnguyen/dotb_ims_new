<?php
// created: 2020-11-12 16:24:49
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
    'link' => true,
  ),
  'product_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_PRODUCT_NAME',
    'id' => 'PRODUCT_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Products',
    'target_record_key' => 'product_id',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_STATUS',
    'width' => 10,
  ),
  'total_quantity' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_TOTAL_QUANTITY',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => 10,
  ),
  'limit_quantity' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_LIMIT_QUANTITY',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => 10,
  ),
  'unit_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_UNIT',
    'id' => 'UNIT_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'J_Unit',
    'target_record_key' => 'unit_id',
  ),
  'date_active' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DATE_ACTIVE',
    'width' => 10,
    'default' => true,
  ),
  'payment_expired' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_PAYMENT_EXPIRED',
    'width' => 10,
    'default' => true,
  ),
  'date_modified' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => 10,
    'default' => true,
  ),
  'currency_id' => 
  array (
    'name' => 'currency_id',
    'usage' => 'query_only',
  ),
  'payment_amount' => 
  array (
    'name' => 'payment_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'paid_amount' => 
  array (
    'name' => 'paid_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'deposit_amount' => 
  array (
    'name' => 'deposit_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'contract_id' => 
  array (
    'name' => 'contract_id',
    'usage' => 'query_only',
  ),
  'description' => 
  array (
    'name' => 'description',
    'usage' => 'query_only',
  ),
);