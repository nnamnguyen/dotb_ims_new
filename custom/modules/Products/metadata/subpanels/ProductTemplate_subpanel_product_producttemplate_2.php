<?php
// created: 2020-08-06 11:23:44
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'sort_by' => 'products.name',
    'default' => true,
  ),
  'status' => 
  array (
    'vname' => 'LBL_LIST_STATUS',
    'width' => 10,
    'default' => true,
  ),
  'account_name' => 
  array (
    'vname' => 'LBL_LIST_ACCOUNT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'account_id',
    'target_module' => 'Accounts',
    'module' => 'Accounts',
    'width' => 10,
    'sortable' => false,
    'default' => true,
  ),
  'contact_name' => 
  array (
    'vname' => 'LBL_LIST_CONTACT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'contact_id',
    'target_module' => 'Contacts',
    'module' => 'Contacts',
    'width' => 10,
    'sortable' => false,
    'default' => true,
  ),
  'date_purchased' => 
  array (
    'vname' => 'LBL_LIST_DATE_PURCHASED',
    'width' => 10,
    'default' => true,
  ),
  'discount_price' => 
  array (
    'vname' => 'LBL_LIST_DISCOUNT_PRICE',
    'width' => 10,
    'sortable' => false,
    'default' => true,
  ),
  'date_support_expires' => 
  array (
    'vname' => 'LBL_LIST_SUPPORT_EXPIRES',
    'width' => 10,
    'default' => true,
  ),
  'discount_usdollar' => 
  array (
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'currency_id' => 
  array (
    'name' => 'currency_id',
    'usage' => 'query_only',
  ),
);