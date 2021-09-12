<?php

$relationships = array (
  'quotes_c_sitedeployment_1' => 
  array (
    'name' => 'quotes_c_sitedeployment_1',
    'true_relationship_type' => 'one-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
      'quotes_c_sitedeployment_1' => 
      array (
        'lhs_module' => 'Quotes',
        'lhs_table' => 'quotes',
        'lhs_key' => 'id',
        'rhs_module' => 'C_SiteDeployment',
        'rhs_table' => 'c_sitedeployment',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'quotes_c_sitedeployment_1_c',
        'join_key_lhs' => 'quotes_c_sitedeployment_1quotes_ida',
        'join_key_rhs' => 'quotes_c_sitedeployment_1c_sitedeployment_idb',
      ),
    ),
    'table' => 'quotes_c_sitedeployment_1_c',
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
      'quotes_c_sitedeployment_1quotes_ida' => 
      array (
        'name' => 'quotes_c_sitedeployment_1quotes_ida',
        'type' => 'id',
      ),
      'quotes_c_sitedeployment_1c_sitedeployment_idb' => 
      array (
        'name' => 'quotes_c_sitedeployment_1c_sitedeployment_idb',
        'type' => 'id',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'idx_quotes_c_sitedeployment_1_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_quotes_c_sitedeployment_1_ida1_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'quotes_c_sitedeployment_1quotes_ida',
          1 => 'deleted',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_quotes_c_sitedeployment_1_idb2_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'quotes_c_sitedeployment_1c_sitedeployment_idb',
          1 => 'deleted',
        ),
      ),
      3 => 
      array (
        'name' => 'quotes_c_sitedeployment_1_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'quotes_c_sitedeployment_1c_sitedeployment_idb',
        ),
      ),
    ),
    'lhs_module' => 'Quotes',
    'lhs_table' => 'quotes',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SiteDeployment',
    'rhs_table' => 'c_sitedeployment',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'quotes_c_sitedeployment_1_c',
    'join_key_lhs' => 'quotes_c_sitedeployment_1quotes_ida',
    'join_key_rhs' => 'quotes_c_sitedeployment_1c_sitedeployment_idb',
    'readonly' => true,
    'relationship_name' => 'quotes_c_sitedeployment_1',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'c_sitedeployment_c_parentapplicense_1' => 
  array (
    'name' => 'c_sitedeployment_c_parentapplicense_1',
    'true_relationship_type' => 'one-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
      'c_sitedeployment_c_parentapplicense_1' => 
      array (
        'lhs_module' => 'C_SiteDeployment',
        'lhs_table' => 'c_sitedeployment',
        'lhs_key' => 'id',
        'rhs_module' => 'C_ParentAppLicense',
        'rhs_table' => 'c_parentapplicense',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'c_sitedeployment_c_parentapplicense_1_c',
        'join_key_lhs' => 'c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida',
        'join_key_rhs' => 'c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb',
      ),
    ),
    'table' => 'c_sitedeployment_c_parentapplicense_1_c',
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
      'c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida' => 
      array (
        'name' => 'c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida',
        'type' => 'id',
      ),
      'c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb' => 
      array (
        'name' => 'c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb',
        'type' => 'id',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'idx_c_sitedeployment_c_parentapplicense_1_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_c_sitedeployment_c_parentapplicense_1_ida1_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida',
          1 => 'deleted',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_c_sitedeployment_c_parentapplicense_1_idb2_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb',
          1 => 'deleted',
        ),
      ),
      3 => 
      array (
        'name' => 'c_sitedeployment_c_parentapplicense_1_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb',
        ),
      ),
    ),
    'lhs_module' => 'C_SiteDeployment',
    'lhs_table' => 'c_sitedeployment',
    'lhs_key' => 'id',
    'rhs_module' => 'C_ParentAppLicense',
    'rhs_table' => 'c_parentapplicense',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'c_sitedeployment_c_parentapplicense_1_c',
    'join_key_lhs' => 'c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida',
    'join_key_rhs' => 'c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb',
    'readonly' => true,
    'relationship_name' => 'c_sitedeployment_c_parentapplicense_1',
    'rhs_subpanel' => 'ForC_sitedeploymentC_sitedeployment_c_parentapplicense_1',
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'c_sitedeployment_modified_user' => 
  array (
    'name' => 'c_sitedeployment_modified_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SiteDeployment',
    'rhs_table' => 'c_sitedeployment',
    'rhs_key' => 'modified_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'c_sitedeployment_modified_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'c_sitedeployment_created_by' => 
  array (
    'name' => 'c_sitedeployment_created_by',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SiteDeployment',
    'rhs_table' => 'c_sitedeployment',
    'rhs_key' => 'created_by',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'c_sitedeployment_created_by',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'c_sitedeployment_activities' => 
  array (
    'name' => 'c_sitedeployment_activities',
    'lhs_module' => 'C_SiteDeployment',
    'lhs_table' => 'c_sitedeployment',
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
    'relationship_role_column_value' => 'C_SiteDeployment',
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
    'relationship_name' => 'c_sitedeployment_activities',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'c_sitedeployment_following' => 
  array (
    'name' => 'c_sitedeployment_following',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SiteDeployment',
    'rhs_table' => 'c_sitedeployment',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'subscriptions',
    'join_key_lhs' => 'created_by',
    'join_key_rhs' => 'parent_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'C_SiteDeployment',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'c_sitedeployment_following',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'c_sitedeployment_favorite' => 
  array (
    'name' => 'c_sitedeployment_favorite',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SiteDeployment',
    'rhs_table' => 'c_sitedeployment',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'dotbfavorites',
    'join_key_lhs' => 'modified_user_id',
    'join_key_rhs' => 'record_id',
    'relationship_role_column' => 'module',
    'relationship_role_column_value' => 'C_SiteDeployment',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'c_sitedeployment_favorite',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'c_sitedeployment_assigned_user' => 
  array (
    'name' => 'c_sitedeployment_assigned_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SiteDeployment',
    'rhs_table' => 'c_sitedeployment',
    'rhs_key' => 'assigned_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'c_sitedeployment_assigned_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'c_sitedeployment_c_crmlicense_1' => 
  array (
    'rhs_label' => 'CRMLicense',
    'lhs_label' => 'SiteDeployment',
    'rhs_subpanel' => 'default',
    'lhs_module' => 'C_SiteDeployment',
    'rhs_module' => 'C_CRMLicense',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
    'relationship_name' => 'c_sitedeployment_c_crmlicense_1',
  ),
);