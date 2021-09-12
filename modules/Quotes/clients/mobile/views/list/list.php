<?php


$viewdefs['Quotes']['mobile']['view']['list'] = array(
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_QUOTE_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'billing_account_name',
                    'label' => 'LBL_ACCOUNT_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
    	),
	),
);