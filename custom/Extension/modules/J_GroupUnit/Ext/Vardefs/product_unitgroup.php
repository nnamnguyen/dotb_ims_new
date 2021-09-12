<?php
$dictionary['J_GroupUnit']['fields']['product_unitgroup'] = array (
    'name' => 'product_unitgroup',
    'type' => 'link',
    'relationship' => 'product_unitgroup',
    'source' => 'non-db',
    'module' => 'ProductTemplates',
    'bean_name' => 'ProductTemplates',
    'id_name' => 'group_unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_GROUP_UNIT_NAME',
);

$dictionary['J_GroupUnit']['relationships']['product_unitgroup'] = array (
    'lhs_module' => 'J_GroupUnit',
    'lhs_table' => 'j_groupunit',
    'lhs_key' => 'id',
    'rhs_module' => 'ProductTemplates',
    'rhs_table' => 'product_templates',
    'rhs_key' => 'group_unit_id',
    'relationship_type' => 'one-to-many'
);