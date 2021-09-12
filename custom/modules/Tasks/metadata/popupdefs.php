<?php
$popupMeta = array (
    'moduleMain' => 'Tasks',
    'varName' => 'Tasks',
    'orderBy' => 'tasks.name',
    'whereClauses' => array (
  'name' => 'tasks.name',
  'status' => 'tasks.status',
  'date_start' => 'tasks.date_start',
  'date_due' => 'tasks.date_due',
  'parent_name' => 'tasks.parent_name',
  'assigned_user_id' => 'tasks.assigned_user_id',
),
    'searchInputs' => array (
  1 => 'name',
  3 => 'status',
  4 => 'date_start',
  5 => 'date_due',
  6 => 'parent_name',
  7 => 'assigned_user_id',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10',
  ),
  'date_start' => 
  array (
    'type' => 'jdatetime',
    'studio' => 
    array (
      'required' => true,
      'no_duplicate' => true,
    ),
    'label' => 'LBL_START_DATE',
    'width' => 10,
    'name' => 'date_start',
  ),
  'date_due' => 
  array (
    'type' => 'jdatetime',
    'studio' => 
    array (
      'required' => true,
      'no_duplicate' => true,
    ),
    'label' => 'LBL_DUE_DATE',
    'width' => 10,
    'name' => 'date_due',
  ),
  'parent_name' => 
  array (
    'type' => 'parent',
    'label' => 'LBL_LIST_RELATED_TO',
    'width' => '10',
    'name' => 'parent_name',
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
  'STATUS' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_STATUS',
    'link' => false,
    'default' => true,
    'name' => 'status',
  ),
  'DATE_START' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_START_DATE',
    'link' => false,
    'default' => true,
    'name' => 'date_start',
  ),
  'DATE_DUE' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_DUE_DATE',
    'link' => false,
    'default' => true,
    'name' => 'date_due',
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
