<?php


$dictionary['contracts_products'] = array(
    'table' => 'contracts_products',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'product_id' => array(
            'name' => 'product_id',
            'type' => 'id',
        ),
        'contract_id' => array(
            'name' => 'contract_id',
            'type' => 'id',
        ),
        'date_modified' => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' => array(
            'name' => 'deleted',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
            'required' => false,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'contracts_prod_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'contracts_prod_alt',
            'type' => 'alternate_key',
            'fields' => array(
                'contract_id',
                'product_id',
            ),
        ),
    ),
    'relationships' => array(
        'contracts_products' => array(
            'lhs_module' => 'Contracts',
            'lhs_table' => 'contracts',
            'lhs_key' => 'id',
            'rhs_module' => 'Products',
            'rhs_table' => 'products',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'contracts_products',
            'join_key_lhs' => 'contract_id',
            'join_key_rhs' => 'product_id',
        ),
    ),
);
