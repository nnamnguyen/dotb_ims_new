<?php

$viewdefs['Notes']['portal']['view']['activity'] = array(
    'buttons' =>
    array(
        0 =>
        array(
            'name' => 'show_more_button',
            'type' => 'button',
            'label' => 'Show More',
            'class' => 'loading wide'
        ),
    ),
    'panels' =>
    array(
        0 =>
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' =>
            array(
                0 =>
                array(
                    'name' => 'name',
                    'default' => true,
                    'enabled' => true,
                    'width' =>  8
                ),
                1 =>
                array(
                    'name' => 'description',
                    'default' => true,
                    'enabled' => true,
                    'width' => 13
                ),
                2 =>
                array(
                    'name' => 'date_entered',
                    'default' => true,
                    'enabled' => true,
                    'width' => 13
                ),
                3 =>
                array(
                    'name' => 'created_by_name',
                    'default' => true,
                    'enabled' => true,
                    'width' => 13
                ),
                4 =>
                array(
                    'name' => 'filename',
                    'default' => true,
                    'enabled' => true,
                    'sorting' => true,
                    'width' => 35
                ),
            ),
        ),
    ),
);
