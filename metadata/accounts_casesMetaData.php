<?php


$dictionary['accounts_cases'] = array(
    'table' => 'accounts_cases',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'account_id' => array(
            'name' => 'account_id',
            'type' => 'id',
        ),
        'case_id' => array(
            'name' => 'case_id',
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
            'required' => false,
            'default' => '0',
        ),
    ),
    'indices' => array(
        array(
            'name' => 'accounts_casespk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_acc_case_acc',
            'type' => 'index',
            'fields' => array(
                'account_id',
            ),
        ),
        array(
            'name' => 'idx_acc_acc_case',
            'type' => 'index',
            'fields' => array(
                'case_id',
            ),
        ),
    ),
);
