<?php
// created: 2019-03-20 17:40:04
$dictionary["j_payment_j_payment_1"] = array (
    'true_relationship_type' => 'one-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
        'j_payment_j_payment_1' => 
        array (
            'lhs_module' => 'J_Payment',
            'lhs_table' => 'j_payment',
            'lhs_key' => 'id',
            'rhs_module' => 'J_Payment',
            'rhs_table' => 'j_payment',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'j_payment_j_payment_1_c',
            'join_key_lhs' => 'j_payment_j_payment_1j_payment_ida',
            'join_key_rhs' => 'j_payment_j_payment_1j_payment_idb',
        ),
    ),
    'table' => 'j_payment_j_payment_1_c',
    'fields' => 
    array (
        'id' => 
        array (
            'name' => 'id',
            'type' => 'id',
        ),
        'date_modified' => 
        array (
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' => 
        array (
            'name' => 'deleted',
            'type' => 'bool',
            'default' => 0,
        ),
        'j_payment_j_payment_1j_payment_ida' => 
        array (
            'name' => 'j_payment_j_payment_1j_payment_ida',
            'type' => 'id',
        ),
        'j_payment_j_payment_1j_payment_idb' => 
        array (
            'name' => 'j_payment_j_payment_1j_payment_idb',
            'type' => 'id',
        ),
        'amount'=>
        array (
            'name' => 'amount',
            'type' => 'decimal',
            'len' => 20,
            'precision' => '2',
        ),
        'hours' =>
        array (
            'name' => 'hours',
            'type' => 'decimal',
            'len' => 13,
            'precision' => '2',
        ),
        'days' =>
        array (
            'name' => 'days',
            'type' => 'decimal',
            'len' => 7,
            'precision' => '2',
        ),
    ),
    'indices' => 
    array (
        0 => 
        array (
            'name' => 'idx_j_payment_j_payment_1_pk',
            'type' => 'primary',
            'fields' => 
            array (
                0 => 'id',
            ),
        ),
        1 => 
        array (
            'name' => 'idx_j_payment_j_payment_1_ida1_deleted',
            'type' => 'index',
            'fields' => 
            array (
                0 => 'j_payment_j_payment_1j_payment_ida',
                1 => 'deleted',
            ),
        ),
        2 => 
        array (
            'name' => 'idx_j_payment_j_payment_1_idb2_deleted',
            'type' => 'index',
            'fields' => 
            array (
                0 => 'j_payment_j_payment_1j_payment_idb',
                1 => 'deleted',
            ),
        ),
        3 => 
        array (
            'name' => 'j_payment_j_payment_1_alt',
            'type' => 'alternate_key',
            'fields' => 
            array (
                0 => 'j_payment_j_payment_1j_payment_idb',
            ),
        ),
    ),
);