<?php

$relationships = array (
  'quotes_b_invoices_1' => 
  array (
    'name' => 'quotes_b_invoices_1',
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
    'lhs_module' => 'Quotes',
    'lhs_table' => 'quotes',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'quotes_b_invoices_1_c',
    'join_key_lhs' => 'quotes_b_invoices_1quotes_ida',
    'join_key_rhs' => 'quotes_b_invoices_1b_invoices_idb',
    'readonly' => true,
    'relationship_name' => 'quotes_b_invoices_1',
    'rhs_subpanel' => 'ForQuotesQuotes_b_invoices_1',
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'accounts_b_invoices_1' => 
  array (
    'name' => 'accounts_b_invoices_1',
    'true_relationship_type' => 'one-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
      'accounts_b_invoices_1' => 
      array (
        'lhs_module' => 'Accounts',
        'lhs_table' => 'accounts',
        'lhs_key' => 'id',
        'rhs_module' => 'B_Invoices',
        'rhs_table' => 'b_invoices',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'accounts_b_invoices_1_c',
        'join_key_lhs' => 'accounts_b_invoices_1accounts_ida',
        'join_key_rhs' => 'accounts_b_invoices_1b_invoices_idb',
      ),
    ),
    'table' => 'accounts_b_invoices_1_c',
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
      'accounts_b_invoices_1accounts_ida' => 
      array (
        'name' => 'accounts_b_invoices_1accounts_ida',
        'type' => 'id',
      ),
      'accounts_b_invoices_1b_invoices_idb' => 
      array (
        'name' => 'accounts_b_invoices_1b_invoices_idb',
        'type' => 'id',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'idx_accounts_b_invoices_1_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_accounts_b_invoices_1_ida1_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'accounts_b_invoices_1accounts_ida',
          1 => 'deleted',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_accounts_b_invoices_1_idb2_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'accounts_b_invoices_1b_invoices_idb',
          1 => 'deleted',
        ),
      ),
      3 => 
      array (
        'name' => 'accounts_b_invoices_1_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'accounts_b_invoices_1b_invoices_idb',
        ),
      ),
    ),
    'lhs_module' => 'Accounts',
    'lhs_table' => 'accounts',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'accounts_b_invoices_1_c',
    'join_key_lhs' => 'accounts_b_invoices_1accounts_ida',
    'join_key_rhs' => 'accounts_b_invoices_1b_invoices_idb',
    'readonly' => true,
    'relationship_name' => 'accounts_b_invoices_1',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'contacts_b_invoices_1' => 
  array (
    'name' => 'contacts_b_invoices_1',
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
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'contacts_b_invoices_1_c',
    'join_key_lhs' => 'contacts_b_invoices_1contacts_ida',
    'join_key_rhs' => 'contacts_b_invoices_1b_invoices_idb',
    'readonly' => true,
    'relationship_name' => 'contacts_b_invoices_1',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'b_invoices_modified_user' => 
  array (
    'name' => 'b_invoices_modified_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'modified_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'b_invoices_modified_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'b_invoices_created_by' => 
  array (
    'name' => 'b_invoices_created_by',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'created_by',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'b_invoices_created_by',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'b_invoices_activities' => 
  array (
    'name' => 'b_invoices_activities',
    'lhs_module' => 'B_Invoices',
    'lhs_table' => 'b_invoices',
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
    'relationship_role_column_value' => 'B_Invoices',
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
    'relationship_name' => 'b_invoices_activities',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'b_invoices_following' => 
  array (
    'name' => 'b_invoices_following',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'subscriptions',
    'join_key_lhs' => 'created_by',
    'join_key_rhs' => 'parent_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'B_Invoices',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'b_invoices_following',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'b_invoices_favorite' => 
  array (
    'name' => 'b_invoices_favorite',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'dotbfavorites',
    'join_key_lhs' => 'modified_user_id',
    'join_key_rhs' => 'record_id',
    'relationship_role_column' => 'module',
    'relationship_role_column_value' => 'B_Invoices',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'b_invoices_favorite',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'b_invoices_assigned_user' => 
  array (
    'name' => 'b_invoices_assigned_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'B_Invoices',
    'rhs_table' => 'b_invoices',
    'rhs_key' => 'assigned_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'b_invoices_assigned_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
);