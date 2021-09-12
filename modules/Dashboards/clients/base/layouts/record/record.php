<?php



$viewdefs['Dashboards']['base']['layout']['record'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'default_hide' => '1',
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
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'help-pane',
                            'css_class' => 'help-pane',
                            'components' => array(
                                array(
                                    'layout' => 'help',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
