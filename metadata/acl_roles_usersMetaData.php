<?php


$dictionary['acl_roles_users'] = array(
    'table' => 'acl_roles_users',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'role_id' => array(
            'name' => 'role_id',
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
        ),
    ),
    'indices' => array(
        array(
            'name' => 'acl_roles_userspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_aclrole_id',
            'type' => 'index',
            'fields' => array(
                'role_id',
            ),
        ),
        array(
            'name' => 'idx_acluser_id',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
        array(
            'name' => 'idx_aclrole_user',
            'type' => 'alternate_key',
            'fields' => array(
                'role_id',
                'user_id',
            ),
        ),
    ),
    'relationships' => array(
        'acl_roles_users' => array(
            'lhs_module' => 'ACLRoles',
            'lhs_table' => 'acl_roles',
            'lhs_key' => 'id',
            'rhs_module' => 'Users',
            'rhs_table' => 'users',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'acl_roles_users',
            'join_key_lhs' => 'role_id',
            'join_key_rhs' => 'user_id',
            'relationship_class' => 'ACLRoleUserRelationship',
            'relationship_file' => 'modules/ACLRoles/ACLRoleUserRelationship.php',
        ),
    ),
);
