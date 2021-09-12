<?php


$viewdefs['Home']['base']['view']['webpage'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_WEBPAGE_NAME',
            'description' => 'LBL_DASHLET_WEBPAGE_DESC',
            'config' => array(
                'url' => '',
                'module' => 'Home',
                'limit' => 3,
            ),
            'preview' => array(
                'title' => 'LBL_DASHLET_WEBPAGE_NAME',
                'url' => '',
                'limit' => '3',
                'module' => 'Home',
            ),
        ),
    ),
    'config' => array(
        'fields' => array(
            array(
                'type' => 'iframe',
                'name' => 'url',
                'label' => 'LBL_DASHLET_WEBPAGE_URL',
                'help' => 'LBL_DASHLET_WEBPAGE_URL_HELP',
            ),
            array(
                'name' => 'limit',
                'label' => 'LBL_DASHLET_CONFIGURE_DISPLAY_ROWS',
                'type' => 'enum',
                'options' => 'dashlet_webpage_limit_options',
            ),
        ),
    ),
    'view_panel' => array(
        array(
            'type' => 'iframe',
            'name' => 'url',
            'label' => 'LBL_DASHLET_WEBPAGE_URL',
            'width' => '100%',

        ),
    ),
);
