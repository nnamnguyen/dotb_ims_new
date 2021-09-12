<?php


$dictionary['metadata_cache'] = array(
    'table' => 'metadata_cache',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'type' => array(
            'name' => 'type',
            'type' => 'varchar',
            'len' => '255',
        ),
        'data' => array(
            'name' => 'data',
            'type' => 'longblob',
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
            'name' => 'matadata_cache_primary',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'type_indx',
            'type' => 'index',
            'fields' => array(
                'type',
            ),
        ),
    ),
);
