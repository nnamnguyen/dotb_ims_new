<?php
// created: 2019-12-09 09:42:43
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_SUBJECT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'status' => 
  array (
    'widget_class' => 'SubPanelActivitiesStatusField',
    'vname' => 'LBL_LIST_STATUS',
    'width' => 10,
    'default' => true,
  ),
  'date_start' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'required' => true,
      'no_duplicate' => true,
    ),
    'vname' => 'LBL_START_DATE',
    'width' => 10,
    'default' => true,
  ),
  'date_due' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'required' => true,
      'no_duplicate' => true,
    ),
    'vname' => 'LBL_DUE_DATE',
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
  'parent_id' => 
  array (
    'usage' => 'query_only',
  ),
  'parent_type' => 
  array (
    'usage' => 'query_only',
  ),
  'filename' => 
  array (
    'usage' => 'query_only',
    'force_exists' => true,
  ),
);