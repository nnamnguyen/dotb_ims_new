<?php


$viewdefs['base']['layout']['subpanel']  = array (
    'template' => 'panel',
    'components' => array (
        array (
            'view' => 'panel-top',
        ),
        array (
            'view' => 'subpanel-list',
        ),
        array (
            'view' => 'list-bottom',
        ),
    ),
    'last_state' => array(
        'id' => 'subpanel'
    ),
);
