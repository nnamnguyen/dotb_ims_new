<?php


$viewdefs['Categories']['base']['layout']['nested-set-list'] = array(
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
                                    'view' => 'nested-set-headerpane',
                                ),
                                array(
                                    'view' => 'tree'
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
                                    'layout' => 'preview',
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
                                    'layout' => 'selection-sidebar',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
