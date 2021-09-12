<?php


$dictionary['contracts_contacts'] = array(
    'table' => 'contracts_contacts',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'contact_id' => array(
            'name' => 'contact_id',
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
            'name' => 'contracts_contacts_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'contracts_contacts_alt',
            'type' => 'alternate_key',
            'fields' => array(
                'contact_id',
                'contract_id',
            ),
        ),
    ),
    'relationships' => array(
        'contracts_contacts' => array(
            'lhs_module' => 'Contracts',
            'lhs_table' => 'contracts',
            'lhs_key' => 'id',
            'rhs_module' => 'Contacts',
            'rhs_table' => 'contacts',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'contracts_contacts',
            'join_key_lhs' => 'contract_id',
            'join_key_rhs' => 'contact_id',
        ),
    ),
);
