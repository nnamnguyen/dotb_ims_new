<?php
// created: 2020-10-23 10:43:54
$dictionary["quotes_j_payment_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'quotes_j_payment_1' => 
    array (
      'lhs_module' => 'Quotes',
      'lhs_table' => 'quotes',
      'lhs_key' => 'id',
      'rhs_module' => 'J_Payment',
      'rhs_table' => 'j_payment',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'quotes_j_payment_1_c',
      'join_key_lhs' => 'quotes_j_payment_1quotes_ida',
      'join_key_rhs' => 'quotes_j_payment_1j_payment_idb',
    ),
  ),
  'table' => 'quotes_j_payment_1_c',
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
    'quotes_j_payment_1quotes_ida' => 
    array (
      'name' => 'quotes_j_payment_1quotes_ida',
      'type' => 'id',
    ),
    'quotes_j_payment_1j_payment_idb' => 
    array (
      'name' => 'quotes_j_payment_1j_payment_idb',
      'type' => 'id',
    ),
      'use_amount' =>
          array(
              'name' => 'use_amount',
              'vname' => 'LBL_TOTAL_AMOUNT',
              'type' => 'currency',
              'default' => 0.0,
              'len' => 26,
              'size' => '20',
              'precision' => 2,
              'related_fields' =>
                  array (
                      0 => 'currency_id',
                      1 => 'base_rate',
                  ),
          ),
      'currency_id' =>
          array (
              'required' => false,
              'name' => 'currency_id',
              'vname' => 'LBL_CURRENCY_ID',
              'type' => 'currency_id',
              'massupdate' => false,
              'no_default' => false,
              'comments' => '',
              'help' => '',
              'importable' => 'true',
              'duplicate_merge' => 'enabled',
              'duplicate_merge_dom_value' => 1,
              'audited' => false,
              'reportable' => true,
              'unified_search' => false,
              'merge_filter' => 'disabled',
              'pii' => false,
              'calculated' => false,
              'len' => 36,
              'size' => '20',
              'dbType' => 'id',
              'studio' => false,
              'function' => 'getCurrencies',
              'function_bean' => 'Currencies',
          ),
      'base_rate' =>
          array (
              'required' => false,
              'name' => 'base_rate',
              'vname' => 'LBL_CURRENCY_RATE',
              'type' => 'decimal',
              'massupdate' => false,
              'no_default' => false,
              'comments' => '',
              'help' => '',
              'importable' => 'true',
              'duplicate_merge' => 'enabled',
              'duplicate_merge_dom_value' => 1,
              'audited' => false,
              'reportable' => true,
              'unified_search' => false,
              'merge_filter' => 'disabled',
              'pii' => false,
              'calculated' => false,
              'len' => 26,
              'size' => '20',
              'enable_range_search' => false,
              'precision' => 2,
              'label' => 'LBL_CURRENCY_RATE',
              'studio' => false,
          ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_quotes_j_payment_1_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_quotes_j_payment_1_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'quotes_j_payment_1quotes_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_quotes_j_payment_1_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'quotes_j_payment_1j_payment_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'quotes_j_payment_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'quotes_j_payment_1quotes_ida',
        1 => 'quotes_j_payment_1j_payment_idb',
      ),
    ),
  ),
);