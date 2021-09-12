<?php


$module_name = '<module_name>';
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
                'name',
                'phone_office',
                array (
                    'name'=>'website',
                    'type'=>'link',
                ),
                'email1',
                'assigned_user_name',
                'team_name',
            ),
  		),
	),
);
