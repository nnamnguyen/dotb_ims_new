<?php

$viewdefs['OutboundEmail']['base']['layout']['record'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span8',
                            'components' => array(
                                array(
                                    'view' => 'record',
                                    'primary' => true,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
