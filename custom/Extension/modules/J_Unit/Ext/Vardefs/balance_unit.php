<?php
//
//$dictionary['J_Unit']['fields']['balance_unit'] = array (
//    'name' => 'balance_unit',
//    'type' => 'link',
//    'relationship' => 'balance_unit',
//    'source' => 'non-db',
//    'module' => 'J_Balance',
//    'bean_name' => 'j_balance',
//    'id_name' => 'unit_id',
//    'link-type' => 'one',
//    'side' => 'left',
//    'vname' => 'LBL_UNIT_NAME',
//);
//
//$dictionary['J_Unit']['relationships']['balance_unit'] = array (
//    'lhs_module' => 'J_Unit',
//    'lhs_table' => 'j_unit',
//    'lhs_key' => 'id',
//    'rhs_module' => 'J_Balance',
//    'rhs_table' => 'j_balance',
//    'rhs_key' => 'unit_id',
//    'relationship_type' => 'one-to-one'
//);
//
$dictionary['J_Unit']['fields']['payment_unit'] = array (
    'name' => 'payment_unit',
    'type' => 'link',
    'relationship' => 'payment_unit',
    'source' => 'non-db',
    'module' => 'J_Payment',
    'bean_name' => 'J_Payment',
    'id_name' => 'unit_id',
    'link-type' => 'one',
    'side' => 'left',
    'vname' => 'LBL_UNIT_NAME',
);

$dictionary['J_Unit']['relationships']['payment_unit'] = array (
    'lhs_module' => 'J_Unit',
    'lhs_table' => 'j_unit',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Payment',
    'rhs_table' => 'j_payment',
    'rhs_key' => 'unit_id',
    'relationship_type' => 'one-to-one'
);