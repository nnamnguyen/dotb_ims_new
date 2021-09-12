<?php


$dictionary['contracts_quotes'] = array(
    'table' => 'contracts_quotes',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'quote_id' => array(
            'name' => 'quote_id',
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
            'name' => 'contracts_quot_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'contracts_quot_alt',
            'type' => 'alternate_key',
            'fields' => array(
                'contract_id',
                'quote_id',
            ),
        ),
    ),
    'relationships' => array(
        'contracts_quotes' => array(
            'lhs_module' => 'Contracts',
            'lhs_table' => 'contracts',
            'lhs_key' => 'id',
            'rhs_module' => 'Quotes',
            'rhs_table' => 'quotes',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'contracts_quotes',
            'join_key_lhs' => 'contract_id',
            'join_key_rhs' => 'quote_id',
        ),
    ),
);
