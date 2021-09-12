<?php

$viewdefs['base']['layout']['history-summary'] = array(
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
                                    'view' => 'history-summary-headerpane',
                                ),
                                array(
                                    'view' => 'history-summary',
                                ),
                                array(
                                    'view' => 'history-summary-list-bottom',
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
                                    'layout' => 'history-summary-preview',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
