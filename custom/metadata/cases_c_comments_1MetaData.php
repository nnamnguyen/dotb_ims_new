<?php
// created: 2020-04-15 17:03:36
$dictionary["cases_c_comments_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'cases_c_comments_1' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'C_Comments',
      'rhs_table' => 'c_comments',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cases_c_comments_1_c',
      'join_key_lhs' => 'cases_c_comments_1cases_ida',
      'join_key_rhs' => 'cases_c_comments_1c_comments_idb',
    ),
  ),
  'table' => 'cases_c_comments_1_c',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'type' => 'id',
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'default' => 0,
    ),
    'cases_c_comments_1cases_ida' => 
    array (
      'name' => 'cases_c_comments_1cases_ida',
      'type' => 'id',
    ),
    'cases_c_comments_1c_comments_idb' => 
    array (
      'name' => 'cases_c_comments_1c_comments_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_cases_c_comments_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_cases_c_comments_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cases_c_comments_1cases_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_cases_c_comments_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cases_c_comments_1c_comments_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'cases_c_comments_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cases_c_comments_1c_comments_idb',
      ),
    ),
  ),
);