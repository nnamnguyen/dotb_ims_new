<?php
// created: 2020-08-04 22:40:15
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_QUOTE_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
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
  'quote_stage' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_QUOTE_STAGE',
    'width' => 10,
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
  'created_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'readonly' => true,
    'vname' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'created_by',
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
    'usage' => 'query_only',
  ),
);