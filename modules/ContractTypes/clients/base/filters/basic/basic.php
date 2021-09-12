<?php


$viewdefs['ContractTypes']['base']['filter']['basic'] = array(
    'create' => false,
    'quicksearch_field' => array('name'),
    'quicksearch_priority' => 1,
    'filters' => array(
        array(
            'id' => 'all_records', // need 'all_records' to make filter irremovable
            'name' => 'LBL_MODULE_NAME',
            'filter_definition' => array(),
            'editable' => false,
        ),
    ),
);
