<?php
// created: 2020-04-23 00:02:38
$dictionary["quotes_b_invoices_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'quotes_b_invoices_1' => 
    array (
      'lhs_module' => 'Quotes',
      'lhs_table' => 'quotes',
      'lhs_key' => 'id',
      'rhs_module' => 'B_Invoices',
      'rhs_table' => 'b_invoices',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'quotes_b_invoices_1_c',
      'join_key_lhs' => 'quotes_b_invoices_1quotes_ida',
      'join_key_rhs' => 'quotes_b_invoices_1b_invoices_idb',
    ),
  ),
  'table' => 'quotes_b_invoices_1_c',
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
    'quotes_b_invoices_1quotes_ida' => 
    array (
      'name' => 'quotes_b_invoices_1quotes_ida',
      'type' => 'id',
    ),
    'quotes_b_invoices_1b_invoices_idb' => 
    array (
      'name' => 'quotes_b_invoices_1b_invoices_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_quotes_b_invoices_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_quotes_b_invoices_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'quotes_b_invoices_1quotes_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_quotes_b_invoices_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'quotes_b_invoices_1b_invoices_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'quotes_b_invoices_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'quotes_b_invoices_1b_invoices_idb',
      ),
    ),
  ),
);