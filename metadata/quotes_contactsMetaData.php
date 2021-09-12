<?php


$dictionary['quotes_contacts'] = array(
    'table' => 'quotes_contacts',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'contact_id' => array(
            'name' => 'contact_id',
            'type' => 'id',
        ),
        'quote_id' => array(
            'name' => 'quote_id',
            'type' => 'id',
        ),
        'contact_role' => array(
            'name' => 'contact_role',
            'type' => 'varchar',
            'len' => '20',
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
            'name' => 'quotes_contactspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_con_qte_con',
            'type' => 'index',
            'fields' => array(
                'contact_id',
            ),
        ),
        array(
            'name' => 'idx_con_qte_opp',
            'type' => 'index',
            'fields' => array(
                'quote_id',
            ),
        ),
        array(
            'name' => 'idx_quote_contact_role',
            'type' => 'alternate_key',
            'fields' => array(
                'quote_id',
                'contact_role',
            ),
        ),
    ),
    'relationships' => array(
        'quotes_contacts_shipto' => array(
            'rhs_module' => 'Quotes',
            'rhs_table' => 'quotes',
            'rhs_key' => 'id',
            'lhs_module' => 'Contacts',
            'lhs_table' => 'contacts',
            'lhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'true_relationship_type' => 'one-to-many',
            'join_table' => 'quotes_contacts',
            'join_key_rhs' => 'quote_id',
            'join_key_lhs' => 'contact_id',
            'relationship_role_column' => 'contact_role',
            'relationship_role_column_value' => 'Ship To',
        ),
        'quotes_contacts_billto' => array(
            'rhs_module' => 'Quotes',
            'rhs_table' => 'quotes',
            'rhs_key' => 'id',
            'lhs_module' => 'Contacts',
            'lhs_table' => 'contacts',
            'lhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'true_relationship_type' => 'one-to-many',
            'join_table' => 'quotes_contacts',
            'join_key_rhs' => 'quote_id',
            'join_key_lhs' => 'contact_id',
            'relationship_role_column' => 'contact_role',
            'relationship_role_column_value' => 'Bill To',
        ),
    ),
);
