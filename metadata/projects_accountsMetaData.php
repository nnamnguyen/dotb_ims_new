<?php


$dictionary['projects_accounts'] = array(
    'table' => 'projects_accounts',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'account_id' => array(
            'name' => 'account_id',
            'type' => 'id',
        ),
        'project_id' => array(
            'name' => 'project_id',
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
            'name' => 'projects_accounts_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_proj_acct_proj',
            'type' => 'index',
            'fields' => array(
                'project_id',
            ),
        ),
        array(
            'name' => 'idx_proj_acct_acct',
            'type' => 'index',
            'fields' => array(
                'account_id',
            ),
        ),
        array(
            'name' => 'projects_accounts_alt',
            'type' => 'alternate_key',
            'fields' => array(
                'project_id',
                'account_id',
            ),
        ),
    ),
    'relationships' => array(
        'projects_accounts' => array(
            'lhs_module' => 'Project',
            'lhs_table' => 'project',
            'lhs_key' => 'id',
            'rhs_module' => 'Accounts',
            'rhs_table' => 'accounts',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'projects_accounts',
            'join_key_lhs' => 'project_id',
            'join_key_rhs' => 'account_id',
        ),
    ),
);
