<?php
$popupMeta = array (
    'moduleMain' => 'C_Comments',
    'varName' => 'C_Comments',
    'orderBy' => 'c_comments.name',
    'whereClauses' => array (
  'name' => 'c_comments.name',
),
    'searchInputs' => array (
  0 => 'c_comments_number',
  1 => 'name',
  2 => 'priority',
  3 => 'status',
),
    'listviewdefs' => array (
  'CASES_C_COMMENTS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CASES_C_COMMENTS_1_FROM_CASES_TITLE',
    'id' => 'CASES_C_COMMENTS_1CASES_IDA',
    'width' => 10,
    'default' => true,
    'name' => 'cases_c_comments_1_name',
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
