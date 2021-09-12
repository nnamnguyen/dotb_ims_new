<?php

$viewdefs['base']['view']['subpanel-list-create'] = array(
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'icon' => 'fa-plus',
                'event' => 'list:addrow:fire',
            ),
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'icon' => 'fa-minus',
                'event' => 'list:deleterow:fire',
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'subpanel-list-create',
    ),
);
