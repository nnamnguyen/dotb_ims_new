<?php

$viewdefs['Releases']['base']['filter']['basic'] = array(
    'create' => false,
    'filters' => array(
        array(
            'id' => 'all_records', // need 'all_records' to make filter irremovable
            'name' => 'LBL_ACTIVE_RELEASES',
            'filter_definition' => array(
                'status' => array(
                    '$in' => array('Active'),
                ),
            ),
            'editable' => false,
        ),
    ),
);
