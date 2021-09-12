<?php

$viewdefs['DRI_Workflows']['base']['layout']['configuration'] = array (
    'components' => array (
        array ('view' => 'config-headerpane'),
        array ('view' => 'config-content'),
        array (
            'layout' => array (
                'components' => array (
                    array ('view' => 'customer-journey-config-users'),
                    array ('view' => 'list-bottom'),
                ),
                'name' => 'customer-journey-config-users',
                'span' => 12,
            ),
            'context' => array ('module' => 'Users'),
        ),
    ),
    'type' => 'configuration',
    'name' => 'base',
    'span' => 12,
);
