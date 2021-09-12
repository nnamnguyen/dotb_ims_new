<?php
// created: 2019-10-23 11:17:08
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'payment_type' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_PAYMENT_TYPE',
    'width' => 10,
  ),
  'class_string' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_CLASS_STRING',
    'width' => 10,
  ),
  'sale_type' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_SALE_TYPE',
    'width' => 10,
  ),
  'payment_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_PAYMENT_DATE',
    'width' => 10,
    'default' => true,
  ),
  'payment_amount' => 
  array (
    'type' => 'currency',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'vname' => 'LBL_GRAND_TOTAL',
    'currency_format' => true,
    'width' => 10,
  ),
  'tuition_hours' => 
  array (
    'type' => 'decimal',
    'default' => true,
    'vname' => 'LBL_TUITION_HOURS',
    'width' => 10,
  ),
  'remain_amount' => 
  array (
    'type' => 'currency',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'vname' => 'LBL_REMAIN_AMOUNT',
    'currency_format' => true,
    'width' => 10,
  ),
  'remain_hours' => 
  array (
    'type' => 'decimal',
    'default' => true,
    'vname' => 'LBL_REMAIN_HOURS',
    'width' => 10,
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
);