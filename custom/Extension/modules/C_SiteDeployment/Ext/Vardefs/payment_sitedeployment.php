<?php
$dictionary['C_SiteDeployment']['fields']['payment_sitedeployment'] = array (
    'name' => 'payment_sitedeployment',
    'type' => 'link',
    'relationship' => 'payment_sitedeployment',
    'source' => 'non-db',
    'module' => 'J_Payment',
    'bean_name' => 'J_Payment',
    'id_name' => 'unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_SITE_NAME',
);

$dictionary['C_SiteDeployment']['relationships']['payment_sitedeployment'] = array (
    'lhs_module' => 'C_SiteDeployment',
    'lhs_table' => 'c_sitedeployment',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Payment',
    'rhs_table' => 'j_payment',
    'rhs_key' => 'site_id',
    'relationship_type' => 'one-to-many'
);