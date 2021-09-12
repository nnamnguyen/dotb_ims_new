<?php
$dictionary['J_Unit']['fields']['unit_base_unit'] = array (
    'name' => 'unit_base_unit',
    'type' => 'link',
    'relationship' => 'unit_base_unit',
    'source' => 'non-db',
    'module' => 'J_Unit',
    'bean_name' => 'j_unit',
    'id_name' => 'base_unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_BASE_UNIT_NAME',
);

$dictionary['J_Unit']['relationships']['unit_base_unit'] = array (
    'lhs_module' => 'J_Unit',
    'lhs_table' => 'j_unit',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Unit',
    'rhs_table' => 'j_unit',
    'rhs_key' => 'base_unit_id',
    'relationship_type' => 'one-to-one'
);