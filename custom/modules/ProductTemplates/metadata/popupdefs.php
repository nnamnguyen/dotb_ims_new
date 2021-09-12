<?php
$popupMeta = array (
    'moduleMain' => 'ProductTemplates',
    'varName' => 'ProductTemplate',
    'orderBy' => 'producttemplates.name',
    'whereClauses' => array (
  'name' => 'producttemplates.name',
  'code' => 'producttemplates.code',
  'list_price' => 'producttemplates.list_price',
  'unit' => 'producttemplates.unit',
  'type_name' => 'producttemplates.type_name',
  'status2' => 'producttemplates.status2',
  'date_available' => 'producttemplates.date_available',
  'status' => 'producttemplates.status',
  'description' => 'producttemplates.description',
),
    'searchInputs' => array (
  0 => 'name',
  2 => 'code',
  3 => 'list_price',
  4 => 'unit',
  5 => 'type_name',
  6 => 'status2',
  7 => 'date_available',
  8 => 'status',
  9 => 'description',
),
    'searchdefs' => array (
  'code' => 
  array (
    'type' => 'varchar',
    'studio' => 'visible',
    'label' => 'LBL_CODE',
    'width' => 10,
    'name' => 'code',
  ),
  'name' => 
  array (
    'name' => 'name',
    'width' => 10,
  ),
  'list_price' => 
  array (
    'type' => 'currency',
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'label' => 'LBL_LIST_PRICE',
    'currency_format' => true,
    'width' => 10,
    'name' => 'list_price',
  ),
  'unit' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_UNIT',
    'width' => 10,
    'name' => 'unit',
  ),
  'type_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_TYPE',
    'id' => 'TYPE_ID',
    'width' => 10,
    'name' => 'type_name',
  ),
  'status2' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_STATUS_2',
    'width' => 10,
    'name' => 'status2',
  ),
  'date_available' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_AVAILABLE',
    'width' => 10,
    'name' => 'date_available',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_STATUS',
    'width' => 10,
    'name' => 'status',
  ),
  'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => 10,
    'name' => 'description',
  ),
),
    'listviewdefs' => array (
  'CODE' => 
  array (
    'type' => 'varchar',
    'studio' => 'visible',
    'label' => 'LBL_CODE',
    'width' => 10,
    'default' => true,
    'name' => 'code',
  ),
  'NAME' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'LIST_PRICE' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_LIST_PRICE',
    'currency_format' => true,
    'width' => 10,
    'default' => true,
    'name' => 'list_price',
  ),
  'UNIT' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_UNIT',
    'width' => 10,
    'default' => true,
    'name' => 'unit',
  ),
  'TYPE_NAME' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_TYPE',
    'sortable' => true,
    'default' => true,
    'name' => 'type_name',
  ),
  'STATUS2' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_STATUS_2',
    'width' => 10,
    'default' => true,
    'name' => 'status2',
  ),
  'DATE_AVAILABLE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_AVAILABLE',
    'width' => 10,
    'default' => true,
    'name' => 'date_available',
  ),
  'STATUS' => 
  array (
    'width' => 10,
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
    'name' => 'status',
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
),
);
