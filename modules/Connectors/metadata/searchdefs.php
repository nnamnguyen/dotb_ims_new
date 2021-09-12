<?php



$searchdefs = array(
    'ext_rest_zoominfocompany' => array(
        'Leads' => array(
            'companyname',
            'state',
            'countrycode'
        ),
        'Accounts' => array(
            'companyname',
            'state',
            'countrycode'
        ),
        'Contacts' => array(
            'companyname',
            'state',
            'countrycode'
        )
    ),

    'ext_rest_zoominfoperson' => array(
        'Leads' => array(
            'firstname',
            'lastname',
            'email',
            'companyname'
        ),
        'Accounts' => array(
            'email',
            'companyname'
        ),
        'Contacts' => array(
            'firstname',
            'lastname',
            'email',
            'companyname'
        )
    ),
);
