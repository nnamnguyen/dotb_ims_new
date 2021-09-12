<?php



$viewdefs['Home']['base']['view']['tutorial'] = array(
    'record' => array(
        'version' =>1,
        'intro' => 'LBL_TOUR_INTRO',
        'content' => array(
            array(
                'name' => '[href=#Home]',
                'text' => 'LBL_TOUR_CUBE',
                'full' => true,
                'horizAdj' => -11,
                'vertAdj'=> -5,
            ),
            array(
                'name' => '[data-route="#Accounts"]',
                'text' => 'LBL_TOUR_NAV_BAR',
                'full' => true,
                'vertAdj'=> -13,
            ),
            array(
                'name' => '.search-query',
                'text' => 'LBL_TOUR_SEARCH',
                'full' => true,
                'vertAdj'=> -8,
            ),
            array(
                'name' => '.notification-list',
                'text' => 'LBL_TOUR_NOTIFICATIONS',
                'full' => true,
                'horizAdj'=> -8,
            ),
            array(
                'name' => '#userActions',
                'text' => 'LBL_TOUR_AVATAR',
                'full' => true,
                'horizAdj'=> -3,
            ),
            array(
                'name' => '#createList',
                'text' => 'LBL_TOUR_ADD',
                'full' => true,
                'horizAdj'=> -3,
            ),
        ),
    ),
);
