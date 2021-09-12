<?php


$module_name = '<module_name>';
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
                array (
                    'name' => 'full_name',
                    'label' => 'LBL_NAME',
                ),
                array (
                    'name' => 'phone_work',
                ),
                'email',
                'assigned_user_name',
		    	'team_name',
            ),
    	),
	),
);
