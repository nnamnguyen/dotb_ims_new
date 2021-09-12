<?php


$dictionary['linked_documents'] = array(
    'table' => 'linked_documents',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'parent_id' => array(
            'name' => 'parent_id',
            'type' => 'id',
        ),
        'parent_type' => array(
            'name' => 'parent_type',
            'type' => 'varchar',
            'len' => '25',
        ),
        'document_id' => array(
            'name' => 'document_id',
            'type' => 'id',
        ),
        'document_revision_id' => array(
            'name' => 'document_revision_id',
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
            'name' => 'linked_documentspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_parent_document',
            'type' => 'alternate_key',
            'fields' => array(
                'parent_type',
                'parent_id',
                'document_id',
            ),
        ),
    ),
    'relationships' => array(
        'contracts_documents' => array(
            'lhs_module' => 'Contracts',
            'lhs_table' => 'contracts',
            'lhs_key' => 'id',
            'rhs_module' => 'Documents',
            'rhs_table' => 'documents',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'linked_documents',
            'join_key_lhs' => 'parent_id',
            'join_key_rhs' => 'document_id',
            'relationship_role_column' => 'parent_type',
            'relationship_role_column_value' => 'Contracts',
        ),
        'contracttype_documents' => array(
            'lhs_module' => 'ContractTypes',
            'lhs_table' => 'contract_types',
            'lhs_key' => 'id',
            'rhs_module' => 'Documents',
            'rhs_table' => 'documents',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'linked_documents',
            'join_key_lhs' => 'parent_id',
            'join_key_rhs' => 'document_id',
            'relationship_role_column' => 'parent_type',
            'relationship_role_column_value' => 'ContracTemplates',
        ),
    ),
);
