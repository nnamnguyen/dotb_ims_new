<?php
// created: 2020-11-03 17:20:28
$dictionary["j_discount_products_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'j_discount_products_1' => 
    array (
      'lhs_module' => 'J_Discount',
      'lhs_table' => 'j_discount',
      'lhs_key' => 'id',
      'rhs_module' => 'Products',
      'rhs_table' => 'products',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'j_discount_products_1_c',
      'join_key_lhs' => 'j_discount_products_1j_discount_ida',
      'join_key_rhs' => 'j_discount_products_1products_idb',
    ),
  ),
  'table' => 'j_discount_products_1_c',
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
    'j_discount_products_1j_discount_ida' => 
    array (
      'name' => 'j_discount_products_1j_discount_ida',
      'type' => 'id',
    ),
    'j_discount_products_1products_idb' => 
    array (
      'name' => 'j_discount_products_1products_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_j_discount_products_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_j_discount_products_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'j_discount_products_1j_discount_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_j_discount_products_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'j_discount_products_1products_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'j_discount_products_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'j_discount_products_1j_discount_ida',
        1 => 'j_discount_products_1products_idb',
      ),
    ),
  ),
);