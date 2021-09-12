<?php
$dictionary["ProductTemplate"]["fields"]["product_producttemplate_2"] = array (
    'name' => 'product_producttemplate_2',
    'type' => 'link',
    'relationship' => 'product_producttemplate_2',
    'module' => 'Products',
    'bean_name' => 'Products',
    'source' => 'non-db',
    'vname' => 'LBL_PRODUCT_TEMPLATE_NAME',
    'id_name' => 'product_template_relationship_id',
    'link-type' => 'many',
    'side' => 'left',
);

$dictionary["ProductTemplate"]["relationships"]["product_producttemplate_2"] = array (
    'name' => 'product_producttemplate_2',
    'lhs_module' => 'ProductTemplates',
    'lhs_table' => 'product_templates',
    'lhs_key' => 'id',
    'rhs_module' => 'Products',
    'rhs_table' => 'products',
    'rhs_key' => 'product_template_relationship_id',
    'relationship_type' => 'one-to-many',
);