<?php



$module_name = 'pmse_Inbox';
$viewdefs[$module_name]['base']['layout']['config'] = array(
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
                                    'view' => 'config-headerpane',
                                ),
                                array(
                                    'view' => 'config'
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);