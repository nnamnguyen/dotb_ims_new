<?php


$viewdefs['pmse_Inbox']['base']['layout']['records'] = array(
    'components' => array(
        array(
            'layout' => array(
                'components' => array(
                    array(
                        'layout' => array(
                            'components' => array(
                                array(
                                    'view' => 'list-headerpane',
                                ),
                                array(
                                    'layout' => array(
                                        'type' => 'filterpanel',
                                        'span' => 12,
                                        'last_state' => array(
                                            'id' => 'list-filterpanel',
                                            'defaults' => array(
                                                'toggle-view' => 'list',
                                            ),
                                        ),
                                        'availableToggles' => array(
                                            array(
                                                'name' => 'list',
                                                'icon' => 'fa-table',
                                                'label' => 'LBL_LISTVIEW',
                                            ),
                                            array(
                                                'name' => 'activitystream',
                                                'icon' => 'fa-clock-o',
                                                'label' => 'LBL_ACTIVITY_STREAM',
                                            ),
                                        ),
                                        'components' => array(
                                            array(
                                                'layout' => 'filter',
                                                'loadModule' => 'Filters',
                                                'targetEl' => '.filter',
                                                'position' => 'prepend',
                                            ),
                                            array(
                                                'view' => 'filter-rows',
                                                'targetEl' => '.filter-options',
                                            ),
                                            array(
                                                'view' => 'filter-actions',
                                                'targetEl' => '.filter-options',
                                            ),
                                            array(
                                                'layout' => 'activitystream',
                                                'context' => array(
                                                    'module' => 'Activities',
                                                ),
                                            ),
                                            array(
                                                'layout' => 'list',
                                            ),
                                        ),
                                    ),
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
                                    'layout' => array(
                                        'type' => 'dashboard',
                                        'last_state' => array(
                                            'id' => 'last-visit',
                                        )
                                    ),
                                    'context' => array(
                                        'forceNew' => true,
                                        'module' => 'Home',
                                    ),
                                    'loadModule' => 'Dashboards',
                                ),
                            ),
                            'type' => 'simple',
                            'name' => 'dashboard-pane',
                            'css_class' => 'dashboard-pane',
                        ),
                    ),
                    array(
                        'layout' => array(
                            'components' => array(
                                array(
                                    'layout' => 'preview',
                                ),
                            ),
                            'type' => 'simple',
                            'name' => 'preview-pane',
                            'css_class' => 'preview-pane',
                        ),
                    ),
                ),
                'type' => 'default',
                'name' => 'sidebar',
                'span' => 12,
            ),
        ),
    ),
    'type' => 'records',
    'name' => 'base',
    'span' => 12,
);
