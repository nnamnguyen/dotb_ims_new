<?php


$subpanel_layout = array(
	'top_buttons' => array(
			array('widget_class' => 'SubPanelTopCreateButton'),
	),

	'where' => '',

	'list_fields' => array(
		'resource_name'=>array(
			'vname' => 'LBL_RESOURCE_NAME',
			'width' => '30%',
		),		
        'holiday_date'=>array(
		 	'vname' => 'LBL_HOLIDAY_DATE',
			'width' => '20%',
		),
		'description'=>array(
		 	'vname' => 'LBL_DESCRIPTION',
			'width' => '48%',
			'sortable'=>false,			
		),
		'remove_button'=>array(
			 'widget_class' => 'SubPanelRemoveButtonProjects',
			 'width' => '2%',
		),	
		'first_name' => array(
		    'usage'=>'query_only',
		),
		'last_name' => array(
		    'usage'=>'query_only',
		)		
	),
);
?>
