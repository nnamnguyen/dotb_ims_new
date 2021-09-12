<?php
// created: 2020-01-06 22:50:44
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_SUBJECT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => 10,
    'default' => true,
  ),
  'date_start' => 
  array (
    'vname' => 'LBL_DATE_TIME',
    'width' => 10,
    'default' => true,
  ),
  'status' => 
  array (
    'widget_class' => 'SubPanelActivitiesStatusField',
    'vname' => 'LBL_STATUS',
    'width' => 10,
    'default' => true,
  ),
  'call_result' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_CALL_RESULT',
    'width' => 10,
    'default' => true,
  ),
  'call_recording' => 
  array (
    'type' => 'varchar',
    'readonly' => true,
    'vname' => 'LBL_CALL_RECORDING',
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
  'time_start' => 
  array (
    'usage' => 'query_only',
  ),
  'recurring_source' => 
  array (
    'usage' => 'query_only',
  ),
);