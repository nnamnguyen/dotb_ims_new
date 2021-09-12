<?php



$viewdefs['base']['layout']['dashletselect'] = array(
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
                                    'view' => 'filtered-search',
                                ),
                                array(
                                    'view' => 'dashletselect-headerpane',
                                ),
                                array(
                                    'view' => 'dashletselect',
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
                                    'layout' => 'dashlet-preview',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
