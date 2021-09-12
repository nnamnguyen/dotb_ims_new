<?php

$viewdefs['base']['layout']['subpanel-create'] = array(
    'type' => 'subpanel',
    'template' => 'panel',
    'components' => array (
        array (
            'view' => 'panel-top-create',
        ),
        array (
            'view' => 'subpanel-list-create',
        )
    ),
    'last_state' => array(
        'id' => 'subpanel-create'
    ),
);
