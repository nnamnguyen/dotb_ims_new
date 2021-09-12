<?php



$viewdefs['Home']['base']['layout']['record'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'base',
                'name' => 'main-pane',
                'css_class' => 'main-pane home-dashboard row-fluid',
                'components' => array(
                    array(
                        'layout' => array(
                            'name' => 'dashboard',
                            'type' => 'dashboard',
                            'components' => array(
                                array(
                                    'view' => 'dashboard-headerpane',
                                    'loadModule' => 'Dashboards',
                                ),
                                array(
                                    'layout' => 'dashlet-main',
                                ),
                            ),
                            'last_state' => array(
                                'id' => 'last-visit',
                            ),
                        ),
                        'loadModule' => 'Dashboards',
                    ),
                ),
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'last-visit',
    ),
);
