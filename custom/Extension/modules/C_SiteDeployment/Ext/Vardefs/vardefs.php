<?php 
// Add new field by nnamnguyen
// Number of user mobile
$dictionary['C_SiteDeployment']['fields']['lic_users_mobile'] = array (
    'name' => 'lic_users_mobile',
    'vname' => 'LBL_LIC_USERS_MOBILE',
    'type' => 'int',
    'len' => 11,
);
// $dictionary['C_SiteDeployment']['fields']['lic_key_crm'] = array (
//     'name' => 'lic_key_crm',
//     'vname' => 'LBL_LIC_KEY_CRM',
//     'type' => 'varchar',
//     'len'=> '100',
// );
// $dictionary['C_SiteDeployment']['fields']['lic_key_mobile'] = array (
//     'name' => 'lic_key_mobile',
//     'vname' => 'LBL_LIC_KEY_MOBILE',
//     'type' => 'varchar',
//     'len'=> '100',
// );
$dictionary['C_SiteDeployment']['fields']['date_expired_mobile'] = array (
    'name' => 'date_expired_mobile',
    'vname' => 'LBL_DATE_EXPIRED_MOBILE',
    'type' => 'date',
);
$dictionary['C_SiteDeployment']['fields']['date_start_mobile'] = array (
    'name' => 'date_start_mobile',
    'vname' => 'LBL_DATE_START_MOBILE',
    'type' => 'date',
);
$dictionary['C_SiteDeployment']['fields']['stage'] = array (
    'name' => 'stage',
    'vname' => 'LBL_STAGE',
    'type' => 'enum',
    'len' => '100',
    'options'=>'site_deployment_stage_options',
);

