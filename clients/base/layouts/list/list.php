<?php



$viewdefs['base']['layout']['list'] = array(
    'components' => array(
        array(
            'view' => 'massselection',
        ),
        array(
            'view' => 'massupdate',
        ),
        array(
            'view' => 'massaddtolist',
        ),
        array(
            'view' => 'recordlist',
            'primary' => true,
        ),
        array(
            'view' => 'list-bottom',
        ),
    ),
);
