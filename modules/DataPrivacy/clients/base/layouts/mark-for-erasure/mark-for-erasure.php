<?php

$viewdefs['DataPrivacy']['base']['layout']['mark-for-erasure'] = array(
    'css_class' => 'row-fluid',
    'components' => array(
        array(
            'layout' => array(
                'type' => 'base',
                'name' => 'main-pane',
                'css_class' => 'main-pane span12',
                'components' => array(
                    array(
                        'view' => 'mark-for-erasure-headerpane',
                    ),
                    array(
                        'view' => 'filtered-search',
                    ),
                    array(
                        'view' => 'mark-for-erasure',
                    ),
                ),
            ),
        ),
    ),
);
