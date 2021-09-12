<?php
$dictionary['J_Unit']['fields']['product_item_unit'] = array (
    'name' => 'product_item_unit',
    'type' => 'link',
    'relationship' => 'product_item_unit',
    'source' => 'non-db',
    'module' => 'Products',
    'bean_name' => 'Products',
    'id_name' => 'unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_UNIT',
);

$dictionary['J_Unit']['relationships']['product_item_unit'] = array (
    'lhs_module' => 'J_Unit',
    'lhs_table' => 'j_unit',
    'lhs_key' => 'id',
    'rhs_module' => 'Products',
    'rhs_table' => 'products',
    'rhs_key' => 'unit_id',
    'relationship_type' => 'one-to-many'
);