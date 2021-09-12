<?php

$viewdefs['Styleguide']['base']['layout']['docs'] = array(
    'css_class' => 'styleguide',
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'css_class' => 'main-content',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            'css_class' => 'styleguide main-pane span12',
                            'components' => array(
                                array(
                                    'view' => 'sg-headerpane',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'preview-pane',
                            'css_class' => 'preview-pane',
                            'components' => array(
                                array(
                                    'layout' => 'dashlet-preview',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
