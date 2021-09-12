<?php

$relationships = array (
  'j_discount_quotes_1' => 
  array (
    'name' => 'j_discount_quotes_1',
    'true_relationship_type' => 'many-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
      'j_discount_quotes_1' => 
      array (
        'lhs_module' => 'J_Discount',
        'lhs_table' => 'j_discount',
        'lhs_key' => 'id',
        'rhs_module' => 'Quotes',
        'rhs_table' => 'quotes',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'j_discount_quotes_1_c',
        'join_key_lhs' => 'j_discount_quotes_1j_discount_ida',
        'join_key_rhs' => 'j_discount_quotes_1quotes_idb',
      ),
    ),
    'table' => 'j_discount_quotes_1_c',
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
      'j_discount_quotes_1j_discount_ida' => 
      array (
        'name' => 'j_discount_quotes_1j_discount_ida',
        'type' => 'id',
      ),
      'j_discount_quotes_1quotes_idb' => 
      array (
        'name' => 'j_discount_quotes_1quotes_idb',
        'type' => 'id',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'idx_j_discount_quotes_1_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_j_discount_quotes_1_ida1_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'j_discount_quotes_1j_discount_ida',
          1 => 'deleted',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_j_discount_quotes_1_idb2_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'j_discount_quotes_1quotes_idb',
          1 => 'deleted',
        ),
      ),
      3 => 
      array (
        'name' => 'j_discount_quotes_1_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'j_discount_quotes_1j_discount_ida',
          1 => 'j_discount_quotes_1quotes_idb',
        ),
      ),
    ),
    'lhs_module' => 'J_Discount',
    'lhs_table' => 'j_discount',
    'lhs_key' => 'id',
    'rhs_module' => 'Quotes',
    'rhs_table' => 'quotes',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'j_discount_quotes_1_c',
    'join_key_lhs' => 'j_discount_quotes_1j_discount_ida',
    'join_key_rhs' => 'j_discount_quotes_1quotes_idb',
    'readonly' => true,
    'relationship_name' => 'j_discount_quotes_1',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'j_discount_products_1' => 
  array (
    'name' => 'j_discount_products_1',
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
    'readonly' => true,
    'relationship_name' => 'j_discount_products_1',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'ForProductsJ_discount_products_1',
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'j_discount_j_discount_1' => 
  array (
    'name' => 'j_discount_j_discount_1',
    'true_relationship_type' => 'many-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
      'j_discount_j_discount_1' => 
      array (
        'lhs_module' => 'J_Discount',
        'lhs_table' => 'j_discount',
        'lhs_key' => 'id',
        'rhs_module' => 'J_Discount',
        'rhs_table' => 'j_discount',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'j_discount_j_discount_1_c',
        'join_key_lhs' => 'j_discount_j_discount_1j_discount_ida',
        'join_key_rhs' => 'j_discount_j_discount_1j_discount_idb',
      ),
    ),
    'table' => 'j_discount_j_discount_1_c',
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
      'j_discount_j_discount_1j_discount_ida' => 
      array (
        'name' => 'j_discount_j_discount_1j_discount_ida',
        'type' => 'id',
      ),
      'j_discount_j_discount_1j_discount_idb' => 
      array (
        'name' => 'j_discount_j_discount_1j_discount_idb',
        'type' => 'id',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'idx_j_discount_j_discount_1_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_j_discount_j_discount_1_ida1_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'j_discount_j_discount_1j_discount_ida',
          1 => 'deleted',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_j_discount_j_discount_1_idb2_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'j_discount_j_discount_1j_discount_idb',
          1 => 'deleted',
        ),
      ),
      3 => 
      array (
        'name' => 'j_discount_j_discount_1_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'j_discount_j_discount_1j_discount_ida',
          1 => 'j_discount_j_discount_1j_discount_idb',
        ),
      ),
    ),
    'lhs_module' => 'J_Discount',
    'lhs_table' => 'j_discount',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Discount',
    'rhs_table' => 'j_discount',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'j_discount_j_discount_1_c',
    'join_key_lhs' => 'j_discount_j_discount_1j_discount_ida',
    'join_key_rhs' => 'j_discount_j_discount_1j_discount_idb',
    'readonly' => true,
    'relationship_name' => 'j_discount_j_discount_1',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'j_discount_modified_user' => 
  array (
    'name' => 'j_discount_modified_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Discount',
    'rhs_table' => 'j_discount',
    'rhs_key' => 'modified_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'j_discount_modified_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'j_discount_created_by' => 
  array (
    'name' => 'j_discount_created_by',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Discount',
    'rhs_table' => 'j_discount',
    'rhs_key' => 'created_by',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'j_discount_created_by',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'j_discount_activities' => 
  array (
    'name' => 'j_discount_activities',
    'lhs_module' => 'J_Discount',
    'lhs_table' => 'j_discount',
    'lhs_key' => 'id',
    'rhs_module' => 'Activities',
    'rhs_table' => 'activities',
    'rhs_key' => 'id',
    'rhs_vname' => 'LBL_ACTIVITY_STREAM',
    'relationship_type' => 'many-to-many',
    'join_table' => 'activities_users',
    'join_key_lhs' => 'parent_id',
    'join_key_rhs' => 'activity_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'J_Discount',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => 36,
        'required' => true,
      ),
      'activity_id' => 
      array (
        'name' => 'activity_id',
        'type' => 'id',
        'len' => 36,
        'required' => true,
      ),
      'parent_type' => 
      array (
        'name' => 'parent_type',
        'type' => 'varchar',
        'len' => 100,
      ),
      'parent_id' => 
      array (
        'name' => 'parent_id',
        'type' => 'id',
        'len' => 36,
      ),
      'fields' => 
      array (
        'name' => 'fields',
        'type' => 'json',
        'dbType' => 'longtext',
        'required' => true,
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'vname' => 'LBL_DELETED',
        'type' => 'bool',
        'default' => '0',
      ),
    ),
    'readonly' => true,
    'relationship_name' => 'j_discount_activities',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'j_sponsor_j_discounts' => 
  array (
    'name' => 'j_sponsor_j_discounts',
    'lhs_module' => 'J_Discount',
    'lhs_table' => 'j_discount',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Sponsor',
    'rhs_table' => 'j_sponsor',
    'rhs_key' => 'discount_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'j_sponsor_j_discounts',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'j_discount_following' => 
  array (
    'name' => 'j_discount_following',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Discount',
    'rhs_table' => 'j_discount',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'subscriptions',
    'join_key_lhs' => 'created_by',
    'join_key_rhs' => 'parent_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'J_Discount',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'j_discount_following',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'j_discount_favorite' => 
  array (
    'name' => 'j_discount_favorite',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Discount',
    'rhs_table' => 'j_discount',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'dotbfavorites',
    'join_key_lhs' => 'modified_user_id',
    'join_key_rhs' => 'record_id',
    'relationship_role_column' => 'module',
    'relationship_role_column_value' => 'J_Discount',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'j_discount_favorite',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'j_discount_assigned_user' => 
  array (
    'name' => 'j_discount_assigned_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Discount',
    'rhs_table' => 'j_discount',
    'rhs_key' => 'assigned_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'j_discount_assigned_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
);