<?php

$viewdefs['KBContents']['base']['view']['kbs-dashlet-localizations'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_LOCALIZATIONS_NAME',
            'description' => 'LBL_DASHLET_LOCALIZATIONS_DESCRIPTION',
            'config' => array(
                'module' => 'KBContents',
            ),
            'preview' => array(),
            'filter' => array(
                'module' => array(
                    'KBContents'
                ),
                'view' => 'record',
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_body',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'limit',
                    'label' => 'LBL_DASHLET_CONFIGURE_DISPLAY_ROWS',
                    'type' => 'enum',
                    'options' => 'dashlet_limit_options',
                ),
            ),
        ),
    ),
);
