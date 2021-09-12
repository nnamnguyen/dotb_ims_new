<?php

$viewdefs['Styleguide']['base']['layout']['views'] = array(
    'css_class' => 'styleguide',
    'components' => array(
        array(
            'layout' => array(
                'type' => 'base',
                'name' => 'sidebar',
                'css_class' => 'row-fluid',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span12',
                            'components' => array(
                                array(
                                    'view' => 'sg-headerpane',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
