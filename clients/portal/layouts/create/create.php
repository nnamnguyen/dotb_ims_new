<?php



$viewdefs['portal']['layout']['create'] = array(
    'components' =>
    array(
        array(
            'layout' =>
            array(
                'components' =>
                array(
                    array(
                        'layout' =>
                        array(
                            'components' =>
                            array(
                                array(
                                    'view' => 'create',
                                ),
                            ),
                            'type' => 'simple',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span8',
                            'span' => 8,
                        ),
                    ),
                    array(
                        'layout' =>
                        array(
                            'components' =>
                            array(
                                array(
                                    'layout' => 'preview',
                                ),
                            ),
                            'type' => 'simple',
                            'name' => 'preview-pane',
                            'css_class' => 'preview-pane',
                            'span' => 8,
                        ),
                    ),
                ),
                'type' => 'default',
                'name' => 'sidebar',
                'span' => 12,
            ),
        ),
    ),
    'type' => 'create',
    'name' => 'base',
    'span' => 12,
);
