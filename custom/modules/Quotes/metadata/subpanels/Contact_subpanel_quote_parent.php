<?php
// created: 2020-09-30 14:40:07
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_QUOTE_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'account_name' => 
  array (
    'vname' => 'LBL_LIST_ACCOUNT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'module' => 'Accounts',
    'width' => 10,
    'target_record_key' => 'account_id',
    'target_module' => 'Accounts',
    'sortable' => false,
    'default' => true,
  ),
  'total_usdollar' => 
  array (
    'vname' => 'LBL_LIST_AMOUNT_USDOLLAR',
    'width' => 10,
    'sortable' => false,
    'default' => true,
  ),
  'date_quote_expected_closed' => 
  array (
    'name' => 'date_quote_expected_closed',
    'vname' => 'LBL_LIST_DATE_QUOTE_EXPECTED_CLOSED',
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