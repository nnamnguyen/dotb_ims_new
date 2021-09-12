<?php

$viewdefs['base']['layout']['config-drawer'] = array(
    'type' => 'config-drawer',
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
                            'components' => array(
                                array(
                                    'view' => 'config-header-buttons',
                                ),
                                array(
                                    'layout' => 'config-drawer-content',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'side-pane',
                            'components' => array(
                                array(
                                    'view' => 'config-drawer-howto',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
