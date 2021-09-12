<?php
// created: 2020-11-09 10:18:00
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => 10,
  ),
  'payment_amount' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_PAYMENT_AMOUNT',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => 10,
  ),
  'payment_type' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
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
  'quote_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_QUOTE_NAME',
    'id' => 'QUOTE_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Quotes',
    'target_record_key' => 'quote_id',
  ),
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
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
);