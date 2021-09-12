<?php


$dictionary['contacts_users'] = array(
    'table' => 'contacts_users',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'contact_id' => array(
            'name' => 'contact_id',
            'type' => 'id',
        ),
        'user_id' => array(
            'name' => 'user_id',
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
            'name' => 'contacts_userspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_con_users_con',
            'type' => 'index',
            'fields' => array(
                'contact_id',
            ),
        ),
        array(
            'name' => 'idx_con_users_user',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_contacts_users',
            'type' => 'alternate_key',
            'fields' => array(
                'contact_id',
                'user_id',
            ),
        ),
    ),
    'relationships' => array(
        'contacts_users' => array(
            'lhs_module' => 'Users',
            'lhs_table' => 'users',
            'lhs_key' => 'id',
            'rhs_module' => 'Contacts',
            'rhs_table' => 'contacts',
            'rhs_key' => 'id',
            'relationship_type' => 'user-based',
            'join_table' => 'contacts_users',
            'join_key_lhs' => 'user_id',
            'join_key_rhs' => 'contact_id',
            'user_field' => 'user_id',
        ),
    ),
);
