<?php
$dictionary["ProductTemplate"]["fields"]["unit_id"] = array (
    'name' => 'unit_id',
    'vname' => 'LBL_UNIT_ID',
    'type' => 'id',
    'required'=>true,
    'reportable'=>false,
    'comment' => ''
);

$dictionary["ProductTemplate"]["fields"]["unit_name"] = array (
    'name' => 'unit_name',
    'rname' => 'name',
    'id_name' => 'unit_id',
    'vname' => 'LBL_UNIT',
    'type' => 'relate',
    'link' => 'unit_link',
    'table' => 'j_unit',
    'isnull' => 'true',
    'module' => 'J_Unit',
    'dbType' => 'varchar',
    'len' => 'id',
    'reportable'=>true,
    'source' => 'non-db',
    'auto_populate' => true,
    'dependency' => 'not(equal($group_unit_name,""))',
);

$dictionary["ProductTemplate"]["fields"]["unit_link"] = array (
    'name' => 'unit_link',
    'type' => 'link',
    'relationship' => 'product_unit',
    'link_type' => 'one',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_UNIT',
    'id_name' => 'unit_id',
);