<?php



$module_name = 'pmse_Inbox';
$viewdefs[$module_name]['base']['layout']['reassignCases'] = array(
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
                                    'view' => 'reassignCases-headerpane',
                                ),
                                array(
                                    'layout' => array(
                                        'type' => 'filterpanel',
                                        'last_state' => array(
                                            'id' => 'list-filterpanel',
                                            'defaults' => array(
                                                'toggle-view' => 'list',
                                            ),
                                        ),
                                        'availableToggles' => array(),
                                        'components' => array(
                                            array(
                                                'view' => 'casesList-filter',
                                            ),
                                            array(
                                                'layout' => 'reassignCases-list',
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
