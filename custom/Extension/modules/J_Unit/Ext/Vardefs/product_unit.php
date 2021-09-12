<?php
$dictionary['J_Unit']['fields']['product_unit'] = array (
    'name' => 'product_unit',
    'type' => 'link',
    'relationship' => 'product_unit',
    'source' => 'non-db',
    'module' => 'ProductTemplates',
    'bean_name' => 'ProductTemplates',
    'id_name' => 'unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_UNIT',
);

$dictionary['J_Unit']['relationships']['product_unit'] = array (
    'lhs_module' => 'J_Unit',
    'lhs_table' => 'j_unit',
    'lhs_key' => 'id',
    'rhs_module' => 'ProductTemplates',
    'rhs_table' => 'product_templates',
    'rhs_key' => 'unit_id',
    'relationship_type' => 'one-to-many'
);