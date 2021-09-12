<?php



$viewdefs['base']['layout']['filterpanel'] = array(
    'components' => array(
        array(
            'layout' => 'filter-dropdown',
        ),
        array(
            'view' => 'filter-rows',
        ),
        array(
            'view' => 'filter-actions',
        ),
    ),
);
