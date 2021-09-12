<?php


$viewdefs['base']['layout']['create-dupecheck'] = array(
    'type' => 'dupecheck',
    'components' =>  array(
        array(
            'view' => 'dupecheck-header',
        ),
        array(
            'name' => 'dupecheck-list',
            'view' => 'dupecheck-list',
            'primary' => true,
        ),
    ),
);
