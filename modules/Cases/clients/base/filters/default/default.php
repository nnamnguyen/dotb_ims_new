<?php


$viewdefs['Cases']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'quicksearch_field' => array('name', 'case_number'),
    'quicksearch_priority' => 2,
    'fields' => array(
        'name' => array(),
        'account_name' => array(),
        'last_comment_direction' => array(),
        'status' => array(),
        'priority' => array(),
        'case_number' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'assigned_user_name' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
    ),
    'filters' => array(
        array(
            'id' => 'new_comments',
            'name' => 'New feedback',
            'filter_definition' => array(
                'last_comment_direction' => array(
                    '$equals' => 'inbound'
                ),
                'status' => array(
                    '$not' => 'Closed'
                ),
            ),
            'editable' => false,
            'order' => 1,
        ),
        array(
            'id' => 'favorites',
            'name' => 'LBL_FAVORITES',
            'filter_definition' => array(
                '$favorite' => '',
            ),
            'editable' => false,
            'order' => 2,
        ),
        array(
            'id' => 'all_records',
            'name' => 'LBL_LISTVIEW_FILTER_ALL',
            'filter_definition' => array(),
            'editable' => false,
            'order' => 3,
        ),
    )
);
