<?php
$popupMeta = array (
    'moduleMain' => 'Calls',
    'varName' => 'Calls',
    'orderBy' => 'calls.name',
    'whereClauses' => array (
  'name' => 'calls.name',
  'parent_name' => 'calls.parent_name',
  'date_start' => 'calls.date_start',
  'status' => 'calls.status',
  'call_result' => 'calls.call_result',
  'description' => 'calls.description',
  'assigned_user_id' => 'calls.assigned_user_id',
),
    'searchInputs' => array (
  1 => 'name',
  3 => 'status',
  4 => 'parent_name',
  5 => 'date_start',
  6 => 'call_result',
  7 => 'description',
  8 => 'assigned_user_id',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10',
  ),
  'parent_name' => 
  array (
    'type' => 'parent',
    'label' => 'LBL_LIST_RELATED_TO',
    'width' => '10',
    'name' => 'parent_name',
  ),
  'date_start' => 
  array (
    'type' => 'jdatetime',
    'studio' => 
    array (
      'recordview' => false,
      'wirelesseditview' => false,
    ),
    'label' => 'LBL_CALENDAR_START_DATE',
    'width' => 10,
    'name' => 'date_start',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10',
  ),
  'call_result' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_CALL_RESULT',
    'width' => 10,
    'name' => 'call_result',
  ),
  'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => 10,
    'name' => 'description',
  ),
  'assigned_user_id' => 
  array (
    'name' => 'assigned_user_id',
    'type' => 'enum',
    'label' => 'LBL_ASSIGNED_TO',
    'function' => 
    array (
      'name' => 'get_user_array',
      'params' => 
      array (
        0 => false,
      ),
    ),
    'width' => '10',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'PARENT_NAME' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_RELATED_TO',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'link' => true,
    'default' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'name' => 'parent_name',
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => 10,
    'default' => true,
    'name' => 'description',
  ),
  'RECALL_AT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_RECALL_AT',
    'width' => 10,
    'default' => true,
    'name' => 'recall_at',
  ),
  'DATE_START' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_DATE',
    'link' => false,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'time_start',
    ),
    'name' => 'date_start',
  ),
  'STATUS' => 
  array (
    'width' => 10,
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
    'name' => 'status',
  ),
  'CALL_RESULT' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_CALL_RESULT',
    'width' => 10,
    'default' => true,
    'name' => 'call_result',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
),
);
