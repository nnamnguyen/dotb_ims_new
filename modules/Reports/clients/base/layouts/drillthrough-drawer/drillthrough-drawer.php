<?php


$viewdefs['Reports']['base']['layout']['drillthrough-drawer'] = array(
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
                                    'view' => 'drillthrough-headerpane',
                                ),
                                array(
                                    'layout' => 'drillthrough-list',
                                    'xmeta' => array(
                                        'components' => array(
                                            array(
                                                'view' => 'massupdate',
                                            ),
                                            array(
                                                'view' => 'massaddtolist',
                                            ),
                                            array(
                                                'view' => 'recordlist',
                                                'primary' => true,
                                                'xmeta' => array(
                                                    'favorite' => true,
                                                ),
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
                            'name' => 'dashboard-pane',
                            'css_class' => 'dashboard-pane',
                            'components' => array(
                                array(
                                    'layout' => 'drillthrough-pane',
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
