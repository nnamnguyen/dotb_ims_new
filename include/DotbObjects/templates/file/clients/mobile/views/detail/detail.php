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
                    'name' => 'document_name',
                    'label' => 'LBL_DOC_NAME',
                ),
                array (
                    'name' => 'uploadfile',
                    'displayParams' => array('link'=>'uploadfile', 'id'=>'id'),
                ),
                'active_date',
                'exp_date',
                'assigned_user_name',
	  	    	'team_name',
            ),
    	),
	),
);
