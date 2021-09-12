<?php

$viewdefs['Shippers']['base']['filter']['basic'] = array(
    'create' => true,
    'quicksearch_field' => array('name'),
    'quicksearch_priority' => 1,
    'filters' => array(
        array(
            'id' => 'all_records', // need 'all_records' to make filter irremovable
            'name' => 'LBL_MODULE_NAME',
            'filter_definition' => array(),
            'editable' => false,
        ),
        array(
            'id' => 'active_shippers',
            'name' => 'LBL_FILTER_ACTIVE',
            'filter_definition' => array(
                'status' => array(
                    '$in' => array('Active'),
                ),
            ),
            'editable' => false,
        ),
    ),
);
