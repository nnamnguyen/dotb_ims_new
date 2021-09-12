<?php
$dictionary['Quote']['fields']['order_create_payment'] = array (
    'name' => 'order_create_payment',
    'type' => 'link',
    'relationship' => 'order_create_payment',
    'source' => 'non-db',
    'module' => 'J_Payment',
    'bean_name' => 'J_Payment',
    'id_name' => 'order_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_ORDER_NAME',
);

$dictionary['Quote']['relationships']['order_create_payment'] = array (
    'lhs_module' => 'Quotes',
    'lhs_table' => 'quotes',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Payment',
    'rhs_table' => 'j_payment',
    'rhs_key' => 'order_id',
    'relationship_type' => 'one-to-many'
);