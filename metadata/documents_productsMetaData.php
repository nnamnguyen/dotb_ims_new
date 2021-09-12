<?php


$dictionary['documents_products'] = array(
    'true_relationship_type' => 'many-to-many',
    'relationships' => array(
        'documents_products' => array(
            'lhs_module' => 'Documents',
            'lhs_table' => 'documents',
            'lhs_key' => 'id',
            'rhs_module' => 'Products',
            'rhs_table' => 'products',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'documents_products',
            'join_key_lhs' => 'document_id',
            'join_key_rhs' => 'product_id',
        ),
    ),
    'table' => 'documents_products',
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
        'product_id' => array(
            'name' => 'product_id',
            'type' => 'id',
            'len' => 36,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'documents_productsspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'documents_products_product_id',
            'type' => 'alternate_key',
            'fields' => array(
                'product_id',
                'document_id',
            ),
        ),
        array(
            'name' => 'documents_products_document_id',
            'type' => 'alternate_key',
            'fields' => array(
                'document_id',
                'product_id',
            ),
        ),
    ),
);
