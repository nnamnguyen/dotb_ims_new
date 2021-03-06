<?php
$dictionary['C_SiteDeployment']['fields']['parent_type'] =array(
    'name' => 'parent_type',
    'vname' => 'LBL_PARENT_TYPE',
    'type' => 'parent_type',
    'dbType' => 'varchar',
    'required' => true,
    'group' => 'parent_name',
    'options' => 'parent_type_display_custom',
    'len' => 100,
    'studio' => array('wirelesslistview' => false),
    'comment' => 'The Dotb object to which the call is related',
    'default' => 'Leads',
);
$dictionary['C_SiteDeployment']['fields']['parent_id'] =array(
    'name' => 'parent_id',
    'vname' => 'LBL_LIST_RELATED_TO_ID',
    'type' => 'id',
    'group' => 'parent_name',
    'reportable' => false,
    'comment' => 'The ID of the parent Dotb object identified by parent_type',
    'required' => true
);
$dictionary['C_SiteDeployment']['fields']['parent_name'] =array(
    'name' => 'parent_name',
    'parent_type' => 'record_type_display',
    'type_name' => 'parent_type',
    'id_name' => 'parent_id',
    'vname' => 'LBL_LIST_RELATED_TO',
    'type' => 'parent',
    'group' => 'parent_name',
    'source' => 'non-db',
    'options' => 'parent_type_display_custom',
    'studio' => true,
    'required' => true,
    // 'dependency' => 'equal($payment_type, "Deposit")',
);