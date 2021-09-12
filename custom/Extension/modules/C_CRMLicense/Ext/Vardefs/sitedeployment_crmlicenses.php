<?php
//Add new 3 field side n (right) by nnamnguyen
$dictionary['C_CRMLicense']['fields']['crmlicense_link'] = array(
    'name' => 'crmlicense_link',
    'type' => 'link',
    'relationship' => 'sitedeployment_crmlicenses',
    'link_type' => 'many',
    'side' => 'right',
    'module' => 'C_SiteDeployment',
    'bean_name' => 'C_SiteDeployment',
    'source' => 'non-db',
    'vname' => 'LBL_CRMLICENSE_NAME',
    'id_name' => 'parent_id',
);
$dictionary['C_CRMLicense']['fields']['parent_id'] = array(
    'name' => 'parent_id',
    'vname' => 'LBL_CRMLICENSE_NAME',
    'type' => 'id',
    'required' => false,
    'reportable' => false,
    'comment' => ''
);
$dictionary['C_CRMLicense']['fields']['parent_name'] = array(
    'name' => 'parent_name',
    'rname' => 'name',
    'id_name' => 'parent_id',
    'vname' => 'LBL_CRMLICENSE_NAME_TITLE',
    'type' => 'relate',
    'link' => 'crmlicense_link',
    'table' => 'c_sitedeployment',
    'isnull' => 'true',
    'module' => 'C_SiteDeployment',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable' => true,
    'source' => 'non-db',
);
