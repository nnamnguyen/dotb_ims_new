<?php

$module_name = '<module_name>';
$viewdefs[$module_name]['base']['view']['twitter'] = array(
    'dashlets' => array(
        array(
            'name' => 'LBL_TWITTER_NAME',
            'description' => 'LBL_TWITTER_DESCRIPTION',
            'config' => array(
                'limit' => '20',
            ),
            'preview' => array(
                'title' => 'LBL_TWITTER_MY_ACCOUNT',
                'twitter' => 'dotbcrm',
                'limit' => '3',
            ),
        ),
    ),
    'config' => array(
        'fields' => array(
            array(
                'name' => 'limit',
                'label' => 'LBL_TWITTER_DISPLAY_ROWS',
                'type' => 'enum',
                'options' => array(
                    5 => 5,
                    10 => 10,
                    15 => 15,
                    20 => 20,
                    50 => 50,
                ),
            ),
        ),
    ),
);
