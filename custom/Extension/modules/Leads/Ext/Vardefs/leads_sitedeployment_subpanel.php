<?php
// Add new subpanel Site Deployment for Leads Module by nnamnguyen
$dictionary['Lead']['fields']['lead_sitedeployments'] = array(
    'name' => 'lead_sitedeployments',
    'type' => 'link',
    'relationship' => 'lead_sitedeployments',
    'module' => 'C_SiteDeployment',
    'bean_name' => 'C_SiteDeployment',
    'source' => 'non-db',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_LEAD_SITEDEPLOYMENT',
);
$dictionary['Lead']['relationships']['lead_sitedeployments'] = array (
    'lhs_module'        => 'Leads',
    'lhs_table'            => 'leads',
    'lhs_key'            => 'id',
    'rhs_module'        => 'C_SiteDeployment',
    'rhs_table'            => 'c_sitedeployment',
    'rhs_key'            => 'parent_id',
    'relationship_type'    => 'one-to-many',
);
