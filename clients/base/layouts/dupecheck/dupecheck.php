<?php


$viewdefs['base']['layout']['dupecheck'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'filterpanel',
                'components' => array(
                    array(
                        'layout' => 'dupecheck-filter',
                    ),
                    array(
                        'view' => 'filter-rows',
                    ),
                    array(
                        'view' => 'filter-actions',
                    ),
                )
            ),
        ),
        array(
            'name' => 'dupecheck-list',
            'view' => 'dupecheck-list',
            'primary' => true,
        ),
        array(
            'view' => 'list-bottom',
        ),
    ),
);
