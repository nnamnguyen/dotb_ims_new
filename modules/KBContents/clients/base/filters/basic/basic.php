<?php


$viewdefs['KBContents']['base']['filter']['basic'] = array(
    'create' => true,
    'quicksearch_field' => array('name'),
    'quicksearch_priority' => 1,
    'filters' => array(
        array(
            'id' => 'all_records',
            'name' => 'LBL_LISTVIEW_FILTER_ALL',
            'filter_definition' => array(),
            'editable' => false,
        ),
        array(
            'id' => 'assigned_to_me',
            'name' => 'LBL_LISTVIEW_FILTER_MY',
            'filter_definition' => array(
                '$owner' => '',
            ),
            'editable' => false,
        ),
        array(
            'id' => 'favorites',
            'name' => 'LBL_FAVORITES',
            'filter_definition' => array(
                '$favorite' => '',
            ),
            'editable' => false,
        ),
        array(
            'id' => 'recently_created',
            'name' => 'LBL_NEW_RECORDS',
            'filter_definition' => array(
                'date_entered' => array(
                    '$dateRange' => 'today',
                ),
            ),
            'editable' => false,
        ),
        array(
            'id' => 'by_category',
            'filter_definition' => array(
                    array('category_id' => ''),
                ),
            'editable' => true,
            'is_template' => true,
        ),
        array(
            'id' => 'recently_viewed',
            'name' => 'LBL_RECENTLY_VIEWED',
            'filter_definition' => array(
                '$tracker' => '-7 day',
            ),
            'editable' => false,
        ),
    ),
);
