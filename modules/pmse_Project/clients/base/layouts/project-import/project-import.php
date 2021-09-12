<?php



$module_name = 'pmse_Project';
$viewdefs[$module_name]['base']['layout']['project-import'] = array(
    'components' => array(
        array(
            'layout' =>  array(
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
                                    'view' => 'project-import-headerpane',
                                ),
                                array(
                                    'view' => 'project-import',
                                ),
                                array(
                                    'view' => 'dependency-picker',
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
