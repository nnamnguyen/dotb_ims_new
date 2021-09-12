<?php
$viewdefs['J_Discount']['base']['layout']['quote-discount'] = array(
    'type' => 'selection-list',
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
                                    'view' => 'selection-list-context',
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
                                            ),
                                            array(
                                                'view' => 'filter-rows',
                                            ),
                                            array(
                                                'view' => 'filter-actions',
                                            ),
                                            array(
                                                'view' => 'multi-selection-list',
                                            ),
                                            array(
                                                'view' => 'list-bottom',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'view' => 'quote-discount',
                                ),
//                                array(
//                                    'layout' => 'multi-selection-list',
//                                ),
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
