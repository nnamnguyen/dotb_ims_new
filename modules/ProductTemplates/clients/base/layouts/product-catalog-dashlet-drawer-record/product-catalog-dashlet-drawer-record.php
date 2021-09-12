<?php


$viewdefs['ProductTemplates']['base']['layout']['product-catalog-dashlet-drawer-record'] = array(
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
                                    'view' => 'product-catalog-dashlet-drawer-record',
                                    'primary' => true,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
