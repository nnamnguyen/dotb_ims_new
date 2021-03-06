<?php


$dictionary['documents_opportunities'] = array(
    'true_relationship_type' => 'many-to-many',
    'relationships' => array(
        'documents_opportunities' => array(
            'lhs_module' => 'Documents',
            'lhs_table' => 'documents',
            'lhs_key' => 'id',
            'rhs_module' => 'Opportunities',
            'rhs_table' => 'opportunities',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'documents_opportunities',
            'join_key_lhs' => 'document_id',
            'join_key_rhs' => 'opportunity_id',
        ),
    ),
    'table' => 'documents_opportunities',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'len' => 36,
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
            'required' => true,
        ),
        'document_id' => array(
            'name' => 'document_id',
            'type' => 'id',
            'len' => 36,
        ),
        'opportunity_id' => array(
            'name' => 'opportunity_id',
            'type' => 'id',
            'len' => 36,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'documents_opportunitiesspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_docu_opps_oppo_id',
            'type' => 'alternate_key',
            'fields' => array(
                'opportunity_id',
                'document_id',
            ),
        ),
        array(
            'name' => 'idx_docu_oppo_docu_id',
            'type' => 'alternate_key',
            'fields' => array(
                'document_id',
                'opportunity_id',
            ),
        ),
    ),
);
