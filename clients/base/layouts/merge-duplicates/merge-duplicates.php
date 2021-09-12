<?php



$viewdefs['base']['layout']['merge-duplicates'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'default_hide' => '1',
                'hide_key' => 'hide-merge',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span8',
                            'components' => array(
                                array(
                                    'view' => 'merge-duplicates-headerpane',
                                ),
                                array(
                                    'view' => 'merge-duplicates',
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
                                    'xmeta' => array(
                                        'type' => 'merge-duplicates-preview',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
