<?php


$viewdefs['base']['layout']['selection-list-module-switch'] = array(
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
                                    'view' => 'selection-headerpane',
                                ),
                                array(
                                    'layout' => array(
                                        'type' => 'filterpanel',
                                        'availableToggles' => array(),
                                        'filter_options' => array(
                                            'stickiness' => false,
                                        ),
                                        'components' => array(
                                            array(
                                                'layout' => 'filter',
                                                'loadModule' => 'Filters',
                                                'xmeta' => array(
                                                    'components' => array(
                                                        array(
                                                            'view' => 'filter-module-dropdown-selection-list',
                                                        ),
                                                        array(
                                                            'view' => 'filter-filter-dropdown',
                                                        ),
                                                        array(
                                                            'view' => 'filter-quicksearch',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                            array(
                                                'view' => 'filter-rows',
                                            ),
                                            array(
                                                'view' => 'filter-actions',
                                            ),
                                            array(
                                                'view' => 'selection-list',
                                            ),
                                            array(
                                                'view' => 'list-bottom',
                                            ),
                                        ),
                                    ),
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
                ),
            ),
        ),
    ),
);
