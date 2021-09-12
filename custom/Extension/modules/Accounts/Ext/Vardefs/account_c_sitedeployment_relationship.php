<?php
// Add 2 field (left side) in relationship Accounts and Site Deployment by nnamnguyen
$dictionary['Account']['relationships']['sitedeployment_accounts'] = array (
    'lhs_module'        => 'Accounts',
    'lhs_table'            => 'accounts',
    'lhs_key'            => 'id',
    'rhs_module'        => 'C_SiteDeployment',
    'rhs_table'            => 'c_sitedeployment',
    'rhs_key'            => 'sitedeployment_id',
    'relationship_type'    => 'one-to-many',
);
$dictionary['Account']['fields']['sitedeployment_accounts_link'] = array(
    'name' => 'sitedeployment_accounts_link',
    'type' => 'link',
    'relationship' => 'sitedeployment_accounts',
    'module' => 'C_SiteDeployment',
    'bean_name' => 'C_SiteDeployment',
    'source' => 'non-db',
    'vname' => 'LBL_SITEDEPLOYMENT_ACCOUNTS',
);