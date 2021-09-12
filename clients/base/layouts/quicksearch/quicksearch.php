<?php



$viewdefs['base']['layout']['quicksearch'] = array(
    'components' => array(
        array(
            'view' => 'quicksearch-modulelist',
        ),
        array(
            'view' => 'quicksearch-taglist',
        ),
        array(
            'view' => 'quicksearch-bar',
        ),
        array(
            'view' => 'quicksearch-tags',
        ),
        array(
            'view' => 'quicksearch-results',
        ),
        array(
            'view' => 'quicksearch-button'
        ),
    ),
    'v2' => true,
);
