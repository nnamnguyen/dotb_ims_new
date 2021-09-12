<?php

$viewdefs['DRI_Workflows']['base']['layout']['configure-modules'] = array (
    'components' => array (
        array (
            'layout' => array (
                'components' => array (
                    array (
                        'view' => 'configure-modules-headerpane',
                    ),
                    array (
                        'view' => 'configure-modules-content',
                    ),
                ),
                'type' => 'simple',
                'name' => 'main-pane',
                'span' => 12,
            ),
        ),
        array (
            'layout' => array (
                'components' => array (),
                'type' => 'simple',
                'name' => 'dashboard-pane',
                'span' => 0,
            ),
        ),
    ),
    'type' => 'simple',
    'name' => 'base',
    'span' => 12,
);
