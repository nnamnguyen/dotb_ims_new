<?php
// created: 2020-04-16 21:59:09
$dictionary["contacts_cases_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'contacts_cases_1' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'contacts_cases_1_c',
      'join_key_lhs' => 'contacts_cases_1contacts_ida',
      'join_key_rhs' => 'contacts_cases_1cases_idb',
    ),
  ),
  'table' => 'contacts_cases_1_c',
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
    'contacts_cases_1contacts_ida' => 
    array (
      'name' => 'contacts_cases_1contacts_ida',
      'type' => 'id',
    ),
    'contacts_cases_1cases_idb' => 
    array (
      'name' => 'contacts_cases_1cases_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_contacts_cases_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_contacts_cases_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'contacts_cases_1contacts_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_contacts_cases_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'contacts_cases_1cases_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'contacts_cases_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'contacts_cases_1cases_idb',
      ),
    ),
  ),
);