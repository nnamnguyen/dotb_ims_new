<?php
// Add 2 field (left side) in relationship License and Quoted Line Items by nnamnguyen
$dictionary['Product']['relationships']['license_quotedlineitems_relationship'] = array(
    'lhs_module' => 'Products',
    'lhs_table' => 'products',
    'lhs_key' => 'id',
    'rhs_module' => 'C_CRMLicense',
    'rhs_table' => 'c_crmlicense',
    'rhs_key' => 'license_quotedlineitems_id',
    'relationship_type' => 'one-to-many'
);