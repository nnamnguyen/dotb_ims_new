<?php
// created: 2020-11-09 16:10:08
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'ehd_id' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_EHD_ID',
    'width' => 10,
  ),
  'invoice_type' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_INVOICE_TYPE',
    'width' => 10,
  ),
  'total' => 
  array (
    'type' => 'decimal',
    'default' => true,
    'vname' => 'LBL_TOTAL',
    'width' => 10,
  ),
  'status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_STATUS',
    'width' => 10,
  ),
  'invoice_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_INVOICE_DATE',
    'width' => 10,
    'default' => true,
  ),
  'due_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DUE_DATE',
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