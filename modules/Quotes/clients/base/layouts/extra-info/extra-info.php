<?php



$viewdefs['Quotes']['base']['layout']['extra-info'] = array(
    'components' => array(
//        array(
//            'view' => 'payment_info',
//        ),
        array(
            'view' => 'quote-data-grand-totals-header',
        ),
        array(
            'layout' => 'quote-data-list-groups',
        ),
        array(
            'view' => 'quote-data-grand-totals-footer',
        ),
        array(
            'view' => 'quote-data-use-balance-footer',
        ),
    ),
);
