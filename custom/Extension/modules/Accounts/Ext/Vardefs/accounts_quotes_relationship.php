<?php
// Add 2 field (left side) in relationship Accounts and Quotes by nnamnguyen
$dictionary['Account']['relationships']['quotes_accounts'] = array(
    'lhs_module' => 'Accounts',
    'lhs_table' => 'accounts',
    'lhs_key' => 'id',
    'rhs_module' => 'Quotes',
    'rhs_table' => 'quotes',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many'
);
// $dictionary['Account']['fields']['accounts_quotes_link'] = array(
//     'name' => 'accounts_quotes_link',
//     'type' => 'link',
//     'relationship' => 'quotes_accounts',
//     'module' => 'Quotes',
//     'bean_name' => 'Quote',
//     'source' => 'non-db',
//     'vname' => 'LBL_QUOTE_ACCOUNT_TITLE',
// );
/*
$dictionary['C_SiteDeployment']['fields']['sitedeployment_crmlicenses_link'] = array(
    'name' => 'sitedeployment_crmlicenses_link',
    'type' => 'link',
    'relationship' => 'sitedeployment_crmlicenses',
    'module' => 'C_CRMLicense',
    'bean_name' => 'C_CRMLicense',
    'source' => 'non-db',
    'vname' => 'LBL_SITEDEPLOYMENT_CRMLICENSE',
);
$dictionary['C_SiteDeployment']['relationships']['sitedeployment_crmlicenses'] = array (
    'lhs_module'        => 'C_SiteDeployment',
    'lhs_table'            => 'c_sitedeployment',
    'lhs_key'            => 'id',
    'rhs_module'        => 'C_CRMLicense',
    'rhs_table'            => 'c_crmlicense',
    'rhs_key'            => 'parent_id',
    'relationship_type'    => 'one-to-many',
);
*/
