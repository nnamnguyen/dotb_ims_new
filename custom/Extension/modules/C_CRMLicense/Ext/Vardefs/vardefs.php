<?php
//Add new field by nnamnguyen
$dictionary['C_CRMLicense']['fields']['licensekey'] = array (//Dùng cho cả mobile, crm
    'name' => 'licensekey',
    'vname' => 'LBL_LICENSEKEY',
    'type' => 'varchar',
    'len'=> '100',
    'required' => true
);
$dictionary['C_CRMLicense']['fields']['issuetype'] = array (
    'name' => 'issuetype',
    'vname' => 'LBL_ISSUETYPE',
    'type' => 'enum',
    'options'=>'issue_type_options',
);
$dictionary['C_CRMLicense']['fields']['issuedate'] = array (
    'name' => 'issuedate',
    'vname' => 'LBL_ISSUEDATE',
    'type' => 'date',
    'required'=> true,
    'display_default' => 'now',
);
$dictionary['C_CRMLicense']['fields']['remaindays'] = array (
    'name' => 'remaindays',
    'vname' => 'LBL_REMAINDAYS',
    'type' => 'int',
    'len'=> '5',
);
$dictionary['C_CRMLicense']['fields']['product_id'] = array (//id of Quote Line Items mqh 1-1 với License
    'name' => 'product_id',
    'vname' => 'LBL_PRODUCT_ID',
    'type' => 'char',
    'len'=> '36',
);
$dictionary['C_CRMLicense']['fields']['status'] = array (
    'name' => 'status',
    'vname' => 'LBL_LICENSE_STATUS',
    'type' => 'enum',
    'options'=>'license_status_options',
);

