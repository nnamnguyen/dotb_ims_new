<?php


$module_name = '<module_name>';
$_module_name = '<_module_name>';
$viewdefs[$module_name]['mobile']['view']['edit'] = array(
	'templateMeta' => array('maxColumns' => '1',
                            'widths' => array(
                                            array('label' => '10', 'field' => '30'),
                                            array('label' => '10', 'field' => '30')
                                            ),
                            ),


	'panels' => array (
    	array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => $_module_name . '_number',
                    'displayParams' => array(
                        'required' => false,
                        'wireless_detail_only' => true,
                    ),
                ),
                'priority',
                'status',
                array (
                    'name' => 'name',
                    'label' => 'LBL_SUBJECT',
                ),
                'assigned_user_name',
                'team_name',
            ),
		),
	),
);
