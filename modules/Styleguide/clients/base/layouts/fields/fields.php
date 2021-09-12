<?php

$viewdefs['Styleguide']['base']['layout']['fields'] = array(
    'css_class' => 'styleguide',
    'components' => array(
        array(
            'layout' => array(
                'type' => 'base',
                'css_class' => 'row-fluid',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'css_class' => 'main-pane span12',
                            'components' => array(
                                array(
                                    'view' => 'sg-headerpane',
                                ),
                                array(
                                    'view' => 'fields-index',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
