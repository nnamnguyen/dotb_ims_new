<?php

// Needed by VarDef manager when running the load_fields directive
DotbAutoLoader::load('modules/Tags/TagsRelatedModulesUtilities.php');
$dictionary['Tag'] = array(
    'comment' => 'Tagging module',
    'table' => 'tags',
    'audited' => true,
    'activity_enabled' => false,
    'favorites' => true,
    'optimistic_locking' => false,
    'unified_search' => true,
    'full_text_search' => true,
    'unified_search_default_enabled' => true,
    'required_import_indexes' => array('idx_tag_name::name'),
    'fields' => array(
        'name_lower' => array(
            'name' => 'name_lower',
            'vname' => 'LBL_NAME_LOWER',
            'type' => 'varchar',
            'len' => 255,
            'unified_search' => true,
            'required' => true,
            'reportable' => false,
            'studio' => false,
            'exportable' => false,
        ),
    ),
    'relationships' => array(),
    'indices' => array(
        'name' => array(
            'name' => 'idx_tag_name',
            'type' => 'index',
            'fields' => array('name'),
        ),
        'name_lower' => array(
            'name' => 'idx_tag_name_lower',
            'type' => 'index',
            'fields' => array('name_lower'),
        ),
    ),
    'uses' => array(
        'basic',
        'external_source',
        'assignable',
    ),
    // This can also be a string that maps to a global function. If it's an array
    // it should be static
    'load_fields' => array(
        'class' =>'TagsRelatedModulesUtilities',
        'method' => 'getRelatedFields',
    ),
    // Tags should not implement taggable, but since there is no distinction
    // between basic and default for dotb objects templates yet, we need to
    // forecefully remove the taggable implementation fields. Once there is a
    // separation of default and basic templates we can safely remove these as
    // this module will implement default instead of basic.
    'ignore_templates' => array(
        'taggable',
    ),
    // These ACLs prevent regular users from taking administrative actions on
    // Tag records. This allows view, list and export only.
    'acls' => array(
        'DotbACLDeveloperOrAdmin' => array(
            'aclModule' => 'Tags',
            'allowUserRead' => true,
        ),
    ),
    'duplicate_check' => array(
        'enabled' => true,
        // Use a Tags specific dupe check to enforce cases
        'TagsFilterDuplicateCheck' => array(
            'filter_template' => array(
                array('name' => array('$equals' => '$name')),
            ),
            'ranking_fields' => array(
                array('in_field_name' => 'name', 'dupe_field_name' => 'name'),
            )
        )
    )
);
VardefManager::createVardef(
    'Tags',
    'Tag'
);

// disable full text search on template fields
$dictionary['Tag']['fields']['assigned_user_id']['full_text_search'] = array();
$dictionary['Tag']['fields']['created_by']['full_text_search'] = array();
$dictionary['Tag']['fields']['date_entered']['full_text_search'] = array();
// don't disable date_modified which will be used as default sorting
//$dictionary['Tag']['fields']['date_modified']['full_text_search'] = array();
$dictionary['Tag']['fields']['description']['full_text_search'] = array();
$dictionary['Tag']['fields']['modified_user_id']['full_text_search'] = array();


