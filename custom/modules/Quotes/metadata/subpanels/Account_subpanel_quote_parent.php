<?php
// created: 2020-11-09 10:19:37
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_QUOTE_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
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
  'order_stage' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_ORDER_STAGE',
    'width' => 10,
    'default' => true,
  ),
  'opportunity_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_OPPORTUNITY_NAME',
    'id' => 'OPPORTUNITY_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Opportunities',
    'target_record_key' => 'opportunity_id',
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
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
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