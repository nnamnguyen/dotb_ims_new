<?php
$dictionary["J_PaymentDetail"]["fields"]["receipt_payment"] = array (
    'name' => 'receipt_payment',
    'type' => 'link',
    'relationship' => 'receipt_payment',
    'module' => 'J_Payment',
    'bean_name' => 'J_Payment',
    'source' => 'non-db',
    'vname' => 'LBL_RECEIPT_NAME',
    'id_name' => 'receipt_id',
    'link-type' => 'one',
    'side' => 'left',
);
$dictionary["J_PaymentDetail"]["relationships"]["receipt_payment"] = array (
    'lhs_module' => 'J_PaymentDetail',
    'lhs_table' => 'j_paymentdetail',
    'lhs_key' => 'id',
    'rhs_module' => 'J_Payment',
    'rhs_table' => 'j_payment',
    'rhs_key' => 'receipt_id',
    'relationship_type' => 'one-to-one'
);