<?php

$viewdefs['Quotes']['base']['layout']['create'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'last_state' => array(
                    'id' => 'create-default',
                ),
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span8',
                            'components' => array(
                                array(
                                    'view' => 'create',
                                ),
                                array(
                                    'layout' => 'extra-info',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'preview-pane',
                            'components' => array(
                                array(
                                    'layout' => 'create-preview',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
