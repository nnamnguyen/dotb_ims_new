<?php



$viewdefs['KBContents']['portal']['layout']['rhs-pane'] = array(
    'components' =>
        array(
            array(
                'view' => array(
                    'type' => 'list-dashboard-toolbar',
                ),
            ),
            array(
                'view' =>
                    array(
                        'type' => 'dashlet-nestedset-list',
                        'label' => 'LBL_DASHLET_CATEGORIES_NAME',
                        'data_provider' => 'Categories',
                        'config_provider' => 'KBContents',
                        'root_name' => 'category_root',
                        'extra_provider' => array(
                            'module' => 'KBContents',
                            'field' => 'category_id',
                        ),
                    ),
            ),
        ),
    'css_class' => 'thumbnail dashlet'
);
