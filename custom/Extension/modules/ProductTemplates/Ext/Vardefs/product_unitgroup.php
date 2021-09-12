<?php
$dictionary["ProductTemplate"]["fields"]["group_unit_id"] = array (
    'name' => 'group_unit_id',
    'vname' => 'LBL_GROUP_UNIT_ID',
    'type' => 'id',
    'required'=>true,
    'reportable'=>false,
    'comment' => ''
);

$dictionary["ProductTemplate"]["fields"]["group_unit_name"] = array (
    'name' => 'group_unit_name',
    'rname' => 'name',
    'id_name' => 'group_unit_id',
    'vname' => 'LBL_GROUP_UNIT_NAME',
    'type' => 'relate',
    'link' => 'group_unit_link',
    'table' => 'j_groupunit',
    'isnull' => 'true',
    'module' => 'J_GroupUnit',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable'=>true,
    'source' => 'non-db',
    'auto_populate' => true,
);

$dictionary["ProductTemplate"]["fields"]["group_unit_link"] = array (
    'name' => 'group_unit_link',
    'type' => 'link',
    'relationship' => 'product_unitgroup',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_GROUP_UNIT_NAME',
    'id_name' => 'group_unit_id',
);