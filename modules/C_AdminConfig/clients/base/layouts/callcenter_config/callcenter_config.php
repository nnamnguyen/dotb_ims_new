<?php

$viewdefs['C_AdminConfig']['base']['layout']['callcenter_config'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'base',
                'name' => 'main-pane',
                'css_class' => 'main-pane',
                'components' => array(
                    array(
                        'view' => 'callcenter_config',
                    ),
                ),
            ),
        ),
    ),
);
