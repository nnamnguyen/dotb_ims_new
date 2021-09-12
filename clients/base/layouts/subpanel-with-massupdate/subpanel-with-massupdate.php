<?php

$viewdefs['base']['layout']['subpanel-with-massupdate']  = array (
    'template' => 'panel',
    'components' => array (
        array (
            'view' => 'panel-top',
        ),
        array (
            'view' => 'massupdate',
        ),
        array (
            'view' => 'subpanel-list-with-massupdate',
        ),
        array (
            'view' => 'list-bottom',
        ),
    ),
    'last_state' => array(
        'id' => 'subpanel'
    ),
);
