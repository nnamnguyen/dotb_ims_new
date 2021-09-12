<?php


$module_name = '<module_name>';
$_module_name = '<_module_name>';
$viewdefs[$module_name]['mobile']['view']['detail'] = array(
	'templateMeta' => array('form' => array('buttons'=>array('EDIT', 'DUPLICATE', 'DELETE',)),
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
                $_module_name . '_number',
                'priority',
                'status',
                array (
                    'name' 	=> 'name',
                    'label' => 'LBL_SUBJECT',
                ),
                'assigned_user_name',
		    	'team_name',
            ),
		),
	),
);
