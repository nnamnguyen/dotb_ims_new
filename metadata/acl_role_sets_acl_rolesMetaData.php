<?php


$dictionary['acl_role_sets_acl_roles'] = array(
    'table' => 'acl_role_sets_acl_roles',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'vname' => 'LBL_ID',
            'type' => 'id',
            'required' => true,
        ),
        'acl_role_set_id' => array(
            'name' => 'acl_role_set_id',
            'type' => 'id',
        ),
        'acl_role_id' => array(
            'name' => 'acl_role_id',
            'type' => 'id',
        ),
        'date_modified' => array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' => array(
            'name' => 'deleted',
            'type' => 'bool',
        ),
    ),
    'indices' => array(
        array(
            'name' => 'idx_rsr_id',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_rsr_set_id',
            'type' => 'index',
            'fields' => array(
                'acl_role_set_id',
                'acl_role_id',
            ),
        ),
        array(
            'name' => 'idx_rsr_role_id',
            'type' => 'index',
            'fields' => array(
                'acl_role_id',
            ),
        ),
        array(
            'name' => 'idx_rsr_acl_role_set_id',
            'type' => 'index',
            'fields' => array(
                'acl_role_set_id',
            ),
        ),
    ),
    'relationships' => array(
        'acl_role_sets_acl_roles' => array(
            'lhs_module' => 'ACLRoleSets',
            'lhs_table' => 'acl_role_sets',
            'lhs_key' => 'id',
            'rhs_module' => 'ACLRoles',
            'rhs_table' => 'acl_roles',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'acl_role_sets_roles',
            'join_key_lhs' => 'acl_role_set_id',
            'join_key_rhs' => 'acl_role_id',
        ),
    ),
);
