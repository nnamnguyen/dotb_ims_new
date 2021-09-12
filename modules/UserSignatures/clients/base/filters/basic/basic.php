<?php

$viewdefs['UserSignatures']['base']['filter']['basic'] = array(
    'quicksearch_field' => array('name'),
    'quicksearch_priority' => 1,
    'quicksearch_split_terms' => false,
    'filters' => array(
        array(
            'id' => 'all_records',
            'name' => 'LBL_LISTVIEW_FILTER_ALL',
            'filter_definition' => array(),
            'editable' => false,
        ),
    ),
);
