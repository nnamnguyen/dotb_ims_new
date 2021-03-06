<?php


$dictionary['contracts_opportunities'] = array(
    'table' => 'contracts_opportunities',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'opportunity_id' => array(
            'name' => 'opportunity_id',
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
            'name' => 'contracts_opp_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'contracts_opp_alt',
            'type' => 'alternate_key',
            'fields' => array(
                'contract_id',
            ),
        ),
    ),
    'relationships' => array(
        'contracts_opportunities' => array(
            'lhs_module' => 'Opportunities',
            'lhs_table' => 'opportunities',
            'lhs_key' => 'id',
            'rhs_module' => 'Contracts',
            'rhs_table' => 'contracts',
            'rhs_key' => 'id',
            'relationship_type' => 'one-to-many',
            'join_table' => 'contracts_opportunities',
            'join_key_lhs' => 'opportunity_id',
            'join_key_rhs' => 'contract_id',
            'true_relationship_type' => 'one-to-many',
        ),
    ),
);
