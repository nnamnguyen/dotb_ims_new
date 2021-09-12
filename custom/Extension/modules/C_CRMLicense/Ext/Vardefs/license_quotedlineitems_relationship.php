<?php
// Add new relationship between Licenses and Quoted Line Items
$dictionary['C_CRMLicense']['fields']['license_quotedlineitems_id'] = array(
    'name' => 'license_quotedlineitems_id',
    'vname' => 'LBL_LICENSES_QUOTEDLINEITEMS_ID',
    'type' => 'id',
    'required' => true,
    'reportable' => false,
    'comment' => ''
);
$dictionary['C_CRMLicense']['fields']['license_quotedlineitems_name'] = array(
    'name' => 'license_quotedlineitems_name',
    'rname' => 'name',
    'id_name' => 'license_quotedlineitems_id',
    'vname' => 'LBL_LICENSES_QUOTEDLINEITEMS_NAME',
    'type' => 'relate',
    'link' => 'license_quotedlineitems_link',
    'table' => 'products',
    'isnull' => 'true',
    'module' => 'Products',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable' => true,
    'source' => 'non-db',
    'auto_populate' => true,
);
$dictionary['C_CRMLicense']['fields']['license_quotedlineitems_link'] = array(
    'name' => 'license_quotedlineitems_link',
    'type' => 'link',
    'relationship' => 'license_quotedlineitems_relationship',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_LICENSES_QUOTEDLINEITEMS',
    'id_name' => 'license_quotedlineitems_id',
);