<?php



$viewdefs['base']['layout']['header'] = array(
    'components' => array(
        array(
            'layout' => 'module-list',
        ),
        array(
            'layout' => 'quicksearch',
        ),
        array(
            'view' => 'notifications',
        ),
        array(
            'view' => 'profileactions',
        ),
//        array(
//            'view' => 'quickcreate',
//        ),
    ),
    'last_state' => array(
        'id' => 'app-header',
        'defaults' => array(
            'last-home' => 'dashboard',
        ),
    )
);
