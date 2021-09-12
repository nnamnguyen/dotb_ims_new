<?php

$viewdefs['EmailAddresses']['base']['filter']['basic'] = [
    'create' => true,
    'quicksearch_field' => ['email_address'],
    'quicksearch_priority' => 1,
    'filters' => [
        [
            'id' => 'all_records',
            'name' => 'LBL_LISTVIEW_FILTER_ALL',
            'filter_definition' => [],
            'editable' => false,
        ],
    ],
];
