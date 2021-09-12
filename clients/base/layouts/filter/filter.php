<?php



$viewdefs['base']['layout']['filter'] = array(
    'components' => array(
        array(
            'view' => 'filter-module-dropdown',
        ),
        array(
            'view' => 'filter-filter-dropdown',
        ),
        array(
            'view' => 'filter-quicksearch',
        ),
    ),
    'last_state' => array(
        'id' => 'filter',
    ),
);
