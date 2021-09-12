<?php
// created: 2020-04-23 00:04:45
$dictionary["contacts_b_invoices_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'contacts_b_invoices_1' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'B_Invoices',
      'rhs_table' => 'b_invoices',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'contacts_b_invoices_1_c',
      'join_key_lhs' => 'contacts_b_invoices_1contacts_ida',
      'join_key_rhs' => 'contacts_b_invoices_1b_invoices_idb',
    ),
  ),
  'table' => 'contacts_b_invoices_1_c',
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
    'contacts_b_invoices_1contacts_ida' => 
    array (
      'name' => 'contacts_b_invoices_1contacts_ida',
      'type' => 'id',
    ),
    'contacts_b_invoices_1b_invoices_idb' => 
    array (
      'name' => 'contacts_b_invoices_1b_invoices_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_contacts_b_invoices_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_contacts_b_invoices_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'contacts_b_invoices_1contacts_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_contacts_b_invoices_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'contacts_b_invoices_1b_invoices_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'contacts_b_invoices_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'contacts_b_invoices_1b_invoices_idb',
      ),
    ),
  ),
);