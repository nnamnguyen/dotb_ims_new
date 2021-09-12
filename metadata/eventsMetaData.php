<?php



$dictionary['collections']['events'] = array(
    'name' => 'events',
    'modules' => array(
        'Calls',
        'Meetings',
        array(
            'name' => 'Tasks',
            'field_map' => array(
                'date_end' => 'date_due',
            )
        ),
    ),
    'order_by' => 'date_end:desc',
);
