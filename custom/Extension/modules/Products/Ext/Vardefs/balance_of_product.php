<?php
$dictionary["Product"]["fields"]["balance_of_product"] = array (
    'name' => 'balance_of_product',
    'type' => 'link',
    'relationship' => 'balance_of_product',
    'module' => 'J_Balance',
    'bean_name' => 'J_Balance',
    'source' => 'non-db',
    'vname' => 'LBL_PRODUCT_NAME',
    'id_name' => 'product_id',
    'link-type' => 'one',
    'side' => 'left',
);

$dictionary["Product"]["relationships"]["balance_of_product"] = array (
    'name' => 'balance_of_product',
    'lhs_module' => 'Products',
    'lhs_table' => 'products',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Balance',
    'rhs_table' => 'j_balance',
    'rhs_key' => 'product_id',
    'relationship_type' => 'one-to-many',
);


$dictionary["Product"]["fields"]["payment_of_product"] = array (
    'name' => 'payment_of_product',
    'type' => 'link',
    'relationship' => 'payment_of_product',
    'module' => 'J_Payment',
    'bean_name' => 'J_Payment',
    'source' => 'non-db',
    'vname' => 'LBL_PRODUCT_NAME',
    'id_name' => 'product_id',
    'link-type' => 'one',
    'side' => 'left',
);

$dictionary["Product"]["relationships"]["payment_of_product"] = array (
    'name' => 'payment_of_product',
    'lhs_module' => 'Products',
    'lhs_table' => 'products',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Payment',
    'rhs_table' => 'j_payment',
    'rhs_key' => 'product_id',
    'relationship_type' => 'one-to-many',
);