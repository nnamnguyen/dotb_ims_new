<?php

$viewdefs['KBContents']['base']['layout']['config-drawer'] = array(
    'type' => 'config-drawer',
    'components' => array(
        array(
            'layout' => array(
                'components' => array(
                    array(
                        'layout' => array(
                            'components' => array(
                                array(
                                    'view' => 'config-header-buttons',
                                ),
                                array(
                                    'layout' => 'config-drawer-content',
                                ),
                            ),
                            'type' => 'simple',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span8',
                        ),
                    ),
                    array(
                        'layout' => array(
                            'components' => array(
                                array(
                                    'view' => 'config-drawer-howto',
                                ),
                            ),
                            'type' => 'simple',
                            'name' => 'side-pane',
                            'span' => 4,
                        ),
                    ),
                    array(
                        'layout' => array(
                            'components' => array(),
                            'type' => 'simple',
                            'name' => 'dashboard-pane',
                            'span' => 4,
                        ),
                    ),
                    array(
                        'layout' => array(
                            'components' => array(),
                            'type' => 'simple',
                            'name' => 'preview-pane',
                            'span' => 8,
                        ),
                    ),
                ),
                'type' => 'default',
                'name' => 'sidebar',
                'span' => 12,
            ),
        ),
    ),
    'name' => 'base',
    'span' => 12,
);
