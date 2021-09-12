<?php
// created: 2019-10-14 05:14:27
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
    'link' => true,
  ),
  'contacts_j_payment_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CONTACTS_J_PAYMENT_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_J_PAYMENT_1CONTACTS_IDA',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contacts_j_payment_1contacts_ida',
  ),
  'payment_type' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_PAYMENT_TYPE',
    'width' => 10,
  ),
  'payment_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_PAYMENT_DATE',
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
  'description' => 
  array (
    'name' => 'description',
    'usage' => 'query_only',
  ),
  'paid_amount' => 
  array (
    'name' => 'paid_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'payment_amount' => 
  array (
    'name' => 'payment_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'currency_id' => 
  array (
    'name' => 'currency_id',
    'usage' => 'query_only',
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
);