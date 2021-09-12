<?php


$dictionary['projects_bugs'] = array(
    'table' => 'projects_bugs',
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
        ),
        'bug_id' => array(
            'name' => 'bug_id',
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
            'name' => 'projects_bugs_pk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        array(
            'name' => 'idx_proj_bug_proj',
            'type' => 'index',
            'fields' => array(
                'project_id',
            ),
        ),
        array(
            'name' => 'idx_proj_bug_bug',
            'type' => 'index',
            'fields' => array(
                'bug_id',
            ),
        ),
        array(
            'name' => 'projects_bugs_alt',
            'type' => 'alternate_key',
            'fields' => array(
                'project_id',
                'bug_id',
            ),
        ),
    ),
    'relationships' => array(
        'projects_bugs' => array(
            'lhs_module' => 'Project',
            'lhs_table' => 'project',
            'lhs_key' => 'id',
            'rhs_module' => 'Bugs',
            'rhs_table' => 'bugs',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'projects_bugs',
            'join_key_lhs' => 'project_id',
            'join_key_rhs' => 'bug_id',
        ),
    ),
);
