<?php
// created: 2020-04-15 03:31:01
$dictionary["cases_cases_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'cases_cases_1' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cases_cases_1_c',
      'join_key_lhs' => 'cases_cases_1cases_ida',
      'join_key_rhs' => 'cases_cases_1cases_idb',
    ),
  ),
  'table' => 'cases_cases_1_c',
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
    'cases_cases_1cases_ida' => 
    array (
      'name' => 'cases_cases_1cases_ida',
      'type' => 'id',
    ),
    'cases_cases_1cases_idb' => 
    array (
      'name' => 'cases_cases_1cases_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_cases_cases_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_cases_cases_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cases_cases_1cases_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_cases_cases_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cases_cases_1cases_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'cases_cases_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cases_cases_1cases_idb',
      ),
    ),
  ),
);