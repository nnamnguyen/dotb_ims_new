<?php



$viewdefs['base']['layout']['dashablelist-filter'] = array(
    'components' => array(
        array(
            'layout' => 'filterpanel',
            'xmeta' => array(
                'filter_options' => array(
                    'auto_apply' => false,
                    'stickiness' => false,
                    'show_actions' => false,
                ),
            ),
        ),
    ),
);
