<?php
// Add new subpanel & relationship CRMLicense for Site Deployment Module by nnamnguyen
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