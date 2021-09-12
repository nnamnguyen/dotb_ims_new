<?php
// created: 2020-10-22 16:59:00
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'sort_by' => 'products.name',
    'default' => true,
  ),
  'quote_name' => 
  array (
    'name' => 'quote_name',
    'width' => 10,
    'default' => true,
      'vname' => 'LBL_QUOTE_NAME',
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
  'discount_price' => 
  array (
    'name' => 'discount_price',
    'sortable' => false,
    'width' => 10,
    'default' => true,
      'vname' => 'LBL_DISCOUNT_PRICE',
  ),
  'quantity' => 
  array (
    'name' => 'quantity',
    'width' => 10,
    'default' => true,
      'vname' => 'LBL_LIST_QUANTITY',
  ),
  'total_amount' => 
  array (
    'name' => 'total_amount',
    'sortable' => false,
    'width' => 10,
    'default' => true,
      'vname' => 'LBL_LINE_ITEM_TOTAL'
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
    'name' => 'currency_id',
    'usage' => 'query_only',
  ),
);