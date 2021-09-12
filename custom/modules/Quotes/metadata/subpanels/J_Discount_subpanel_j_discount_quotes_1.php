<?php
// created: 2020-10-22 16:55:57
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
  'total' => 
  array (
    'name' => 'total',
      'vname' => 'LBL_TOTAL',
    'sortable' => false,
    'width' => 10,
    'default' => true,
  ),
  'paid_amount' => 
  array (
      'vname' => 'LBL_PAID_AMOUNT',
    'name' => 'paid_amount',
    'sortable' => false,
    'width' => 10,
    'default' => true,
  ),
  'unpaid_amount' => 
  array (
      'vname' => 'LBL_UNPAID_AMOUNT',
    'name' => 'unpaid_amount',
    'sortable' => false,
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