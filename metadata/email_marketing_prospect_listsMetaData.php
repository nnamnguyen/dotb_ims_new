<?php


$dictionary['email_marketing_prospect_lists'] = array(
    'table' => 'email_marketing_prospect_lists',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'prospect_list_id' => array(
            'name' => 'prospect_list_id',
            'type' => 'id',
        ),
        'email_marketing_id' => array(
            'name' => 'email_marketing_id',
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
        ),
    ),
    'indices' => array(
        array(
            'name' => 'email_mp_listspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'email_mp_prospects',
            'type' => 'alternate_key',
            'fields' => array(
                'email_marketing_id',
                'prospect_list_id',
            ),
        ),
    ),
    'relationships' => array(
        'email_marketing_prospect_lists' => array(
            'lhs_module' => 'EmailMarketing',
            'lhs_table' => 'email_marketing',
            'lhs_key' => 'id',
            'rhs_module' => 'ProspectLists',
            'rhs_table' => 'prospect_lists',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'email_marketing_prospect_lists',
            'join_key_lhs' => 'email_marketing_id',
            'join_key_rhs' => 'prospect_list_id',
        ),
    ),
);
