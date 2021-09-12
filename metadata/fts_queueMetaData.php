<?php


$dictionary['fts_queue'] = array(
    'table' => 'fts_queue',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'bean_id' => array(
            'name' => 'bean_id',
            'dbType' => 'id',
            'type' => 'varchar',
            'len' => '36',
            'comment' => 'FK to various beans\'s tables',
        ),
        'bean_module' => array(
            'name' => 'bean_module',
            'type' => 'varchar',
            'len' => '100',
            'comment' => 'bean\'s Module',
        ),
        'date_modified' => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'date_created' => array(
            'name' => 'date_created',
            'type' => 'datetime',
        ),
        'processed' => array(
            'name' => 'processed',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
            'required' => false,
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_fts_queue_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_beans_bean_id',
            'type' => 'index',
            'fields' => array(
                'bean_module',
                'bean_id',
            ),
        ),
        array(
            'name' => 'idx_beans_bean_id_processed',
            'type' => 'index',
            'fields' => array(
                'bean_module',
                'bean_id',
                'processed',
            ),
        ),
    ),
    'relationships' => array(
    ),
);
