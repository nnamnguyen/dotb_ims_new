<?php


$vardefs = array(
    'fields' => array(
        'tag' => array(
            'name' => 'tag',
            'vname' =>'LBL_TAGS',
            'type' => 'tag',
            'link' => 'tag_link',
            'source' => 'non-db',
            'module' => 'Tags',
            'relate_collection' => true,
            'studio' => array(
                // Tags are not supported on portal yet
                'portal' => false,
                // Tags should not be allowed on popuplist since it is BWC
                'base' => array(
                    'popuplist' => false,
                ),
                // Force the tag field to be exposed to mobile edit and detail view
                // Mobile list, OOTB, will allow tags
                'mobile' => array(
                    'wirelesseditview' => true,
                    'wirelessdetailview' => true,
                ),
            ),
            'massupdate' => true,
            'exportable' => true,
            'sortable' => false,
            'rname' => 'name',
            'full_text_search' => array(
                'enabled' => true,
                'searchable' => false,
            ),
        ),
        'tag_link' => array(
            'name' => 'tag_link',
            'type' => 'link',
            'vname' => 'LBL_TAGS_LINK',
            'relationship' => strtolower($module).'_tags',
            'source' => 'non-db',
            'exportable' => false,
            'duplicate_merge' => 'disabled',
        ),
    ),
    'relationships' => array(
        strtolower($module).'_tags' => array(
            'lhs_module' => $module,
            'lhs_table' => $table_name,
            'lhs_key' => 'id',
            'rhs_module' => 'Tags',
            'rhs_table' => 'tags',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'tag_bean_rel',
            'join_key_lhs' => 'bean_id',
            'join_key_rhs' => 'tag_id',
            'relationship_role_column' => 'bean_module',
            'relationship_role_column_value' => $module,
            'dynamic_subpanel' => true,
        ),
    ),
);
