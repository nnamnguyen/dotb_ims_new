<?php


$viewdefs['Cases']['portal']['view']['list-bottom'] = array(
    'listNav' =>
    array(
        0 =>
        array(
            'name' => 'create_new',
            'type' => 'navelement',
            'icon' => 'fa-plus',
            'label' => ' ',
            'route' =>
            array(
                'action' => 'create',
                'module' => 'Cases',
            ),
        ),
        1 =>
        array(
            'name' => 'show_more_button_back',
            'type' => 'navelement',
            'icon' => 'fa-chevron-left',
            'label' => ' '
        ),
        2 =>
        array(
            'name' => 'show_more_button_forward',
            'type' => 'navelement',
            'icon' => 'fa-chevron-right',
            'label' => ' '
        ),
    ),
);
