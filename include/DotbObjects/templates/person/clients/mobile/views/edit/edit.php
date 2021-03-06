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
                array (
                    'name' => 'first_name',
                    'customCode' => '{html_options name="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
                    'displayParams'=>array('wireless_edit_only'=>true,),
                ),
                array(
                    'name' => 'last_name',
                    'displayParams' => array('wireless_edit_only'=>true,),
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
