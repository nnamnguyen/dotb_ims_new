<?php
// created: 2020-09-21 11:10:59
$dictionary["c_sitedeployment_c_parentapplicense_1"] = array (
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
);