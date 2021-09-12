<?php
$dictionary['J_Discount']['relationships']['product_item_discount'] = array (
    'lhs_module' => 'J_Discount',
    'lhs_table' => 'j_discount',
    'lhs_key' => 'id',
    'rhs_module' => 'Products',
    'rhs_table' => 'products',
    'rhs_key' => 'discount_id',
    'relationship_type' => 'one-to-many'
);