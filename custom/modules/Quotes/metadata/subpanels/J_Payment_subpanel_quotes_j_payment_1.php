<?php
// created: 2020-10-27 10:43:59
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
    'sortable' => false,
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
    'sortable' => false,
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
    'sortable' => false,
  ),
  'order_date' => 
  array (
    'type' => 'jdate',
    'vname' => 'LBL_ORDER_DATE',
    'width' => 10,
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'vname' => 'LBL_ASSIGNED_TO',
    'id' => 'ASSIGNED_USER_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'assigned_user_id',
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
  'team_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'studio' => 
    array (
      'portallistview' => false,
      'portalrecordview' => false,
    ),
    'vname' => 'LBL_TEAMS',
    'id' => 'TEAM_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Teams',
    'target_record_key' => 'team_id',
  ),
  'currency_id' => 
  array (
    'usage' => 'query_only',
  ),
);