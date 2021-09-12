<?php
// created: 2019-10-11 04:27:28
$dictionary["j_payment_j_payment_2"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'j_payment_j_payment_2' => 
    array (
      'lhs_module' => 'J_Payment',
      'lhs_table' => 'j_payment',
      'lhs_key' => 'id',
      'rhs_module' => 'J_Payment',
      'rhs_table' => 'j_payment',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'j_payment_j_payment_2_c',
      'join_key_lhs' => 'j_payment_j_payment_2j_payment_ida',
      'join_key_rhs' => 'j_payment_j_payment_2j_payment_idb',
    ),
  ),
  'table' => 'j_payment_j_payment_2_c',
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
    'j_payment_j_payment_2j_payment_ida' => 
    array (
      'name' => 'j_payment_j_payment_2j_payment_ida',
      'type' => 'id',
    ),
    'j_payment_j_payment_2j_payment_idb' => 
    array (
      'name' => 'j_payment_j_payment_2j_payment_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_j_payment_j_payment_2_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_j_payment_j_payment_2_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'j_payment_j_payment_2j_payment_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_j_payment_j_payment_2_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'j_payment_j_payment_2j_payment_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'j_payment_j_payment_2_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'j_payment_j_payment_2j_payment_idb',
      ),
    ),
  ),
);