<?php

$viewdefs['Documents']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'quicksearch_field' => array('document_name'),
    'quicksearch_priority' => 2,
    'filters' => array(
        array(
            'id' => 'created_by_me',
            'name' => 'LBL_CREATED_BY_ME',
            'filter_definition' => array(
                '$creator' => '',
            ),
            'editable' => false
        ),
    ),
    'fields' => array(
        'document_name' => array(),
        'category_id' => array(),
        'subcategory_id' => array(),
        'status_id' => array(),
        'doc_type' => array(),
        'active_date' => array(),
        'exp_date' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'assigned_user_name' => array(),
        'team_name' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
