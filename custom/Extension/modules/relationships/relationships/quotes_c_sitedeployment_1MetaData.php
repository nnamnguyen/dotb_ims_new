<?php
// created: 2020-04-23 14:11:33
$dictionary["quotes_c_sitedeployment_1"] = array (
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
);