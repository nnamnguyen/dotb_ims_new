<?php


$viewdefs['Quotes']['mobile']['view']['detail'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30')
        ),
    ),
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                'quote_num',
                array (
                    'name' => 'name',
                    'label' => 'LBL_QUOTE_NAME',
                ),
                'billing_account_name',
                'quote_stage',
            ),
    	),
	),
);