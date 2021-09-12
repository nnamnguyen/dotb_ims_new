<?php

$viewdefs['base']['view']['dri-customer-journey-dashlet'] = array(
    'dashlets' => array (
        array (
            'label' => 'LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_DASHLET_TITLE',
            'description' => 'LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_DASHLET_DESC',
            'config' => array (),
            'preview' => array (),
            'filter' => array (
                'module' => array (
                    'Accounts',
                    'Leads',
                    'Contacts',
                    'Cases',
                    'Opportunities',
                    'DRI_Workflows',
                ),
                'view' => 'record'
            ),
        ),
    ),
);
