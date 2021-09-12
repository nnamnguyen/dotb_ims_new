<?php
$dictionary['J_GroupUnit']['fields']['unit_in_group'] = array (
    'name' => 'unit_in_group',
    'type' => 'link',
    'relationship' => 'unit_in_group',
    'source' => 'non-db',
    'module' => 'J_Unit',
    'bean_name' => 'j_unit',
    'id_name' => 'group_unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_GROUP_UNIT_NAME',
);

$dictionary['J_GroupUnit']['relationships']['unit_in_group'] = array (
    'lhs_module' => 'J_GroupUnit',
    'lhs_table' => 'j_groupunit',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Unit',
    'rhs_table' => 'j_unit',
    'rhs_key' => 'group_unit_id',
    'relationship_type' => 'one-to-many'
);