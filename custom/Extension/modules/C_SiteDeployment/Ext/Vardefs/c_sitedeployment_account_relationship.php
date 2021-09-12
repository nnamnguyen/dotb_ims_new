<?php
// Add 3 field (right side) in relationship SiteDeployment and Accounts by nnamnguyen
$dictionary['C_SiteDeployment']['fields']['accounts_sitedeployment_link'] = array(
    'name' => 'accounts_sitedeployment_link',
    'type' => 'link',
    'relationship' => 'sitedeployment_accounts',
    'link_type' => 'many',
    'side' => 'right',
    'module' => 'Accounts',
    'bean_name' => 'Account',
    'source' => 'non-db',
    'vname' => 'LBL_SITEDEPLOYMENT_NAME',
    'id_name' => 'sitedeployment_id',
);
$dictionary['C_SiteDeployment']['fields']['sitedeployment_id'] = array(
    'name' => 'sitedeployment_id',
    'vname' => 'LBL_SITEDEPLOYMENT_NAME_ID',
    'type' => 'id',
    'required' => false,
    'reportable' => false,
    'comment' => ''
);
$dictionary['C_SiteDeployment']['fields']['sitedeployment_account_name'] = array(
    'name' => 'sitedeployment_account_name',
    'rname' => 'name',
    'id_name' => 'sitedeployment_id',
    'vname' => 'LBL_SITEDEPLOYMENT_NAME_TITLE',
    'type' => 'relate',
    'link' => 'accounts_sitedeployment_link',
    'table' => 'accounts',
    'isnull' => 'true',
    'module' => 'Accounts',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable' => true,
    'source' => 'non-db',
);
