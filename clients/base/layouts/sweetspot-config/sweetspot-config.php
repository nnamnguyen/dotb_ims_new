<?php

$viewdefs['base']['layout']['sweetspot-config'] = array(
    'css_class' => 'sweetspot-config',
    'components' => array(
        array(
            'view' => 'sweetspot-config-headerpane',
        ),
        array(
            'layout' => array(
                'type' => 'fluid',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'sweetspot-config-list',
                            'span' => 8,
                        ),
                    ),
                    array(
                        'view' => array(
                            'type' => 'sweetspot-config-theme',
                            'span' => 4,
                        ),
                    ),
                ),
            ),
        ),
    ),
);
