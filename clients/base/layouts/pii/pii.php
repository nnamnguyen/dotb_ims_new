<?php

$viewdefs['base']['layout']['pii'] = array(
    'css_class' => 'row-fluid',
    'components' => array(
        array(
            'layout' => array(
                'type' => 'base',
                'name' => 'main-pane',
                'css_class' => 'main-pane span12',
                'components' => array(
                    array(
                        'view' => 'pii-headerpane',
                    ),
                    array(
                        'view' => 'filtered-search',
                    ),
                    array(
                        'view' => 'pii',
                    ),
                ),
            ),
        ),
    ),
);
