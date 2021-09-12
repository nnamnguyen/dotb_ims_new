<?php


$subpanel_layout = array(
	'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
	),

	'where' => '',


    'list_fields'=> array(
        'name' => array(
	 		'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'width' => '40%',
		),
		'date_start'=>array(
	 		'vname' => 'LBL_LIST_DATE_START',
		 	'width' => '20%',

		),
		'status'=>array(
	 		'vname' => 'LBL_LIST_STATUS',
		 	'width' => '15%',
		),
		'template_name'=>array(
	 		'vname' => 'LBL_LIST_TEMPLATE_NAME',
		 	'width' => '15%',
			'widget_class' => 'SubPanelDetailViewLink',
		  	'target_record_key' => 'template_id',
		 	'target_module' => 'EmailTemplates',
		 
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'EmailMarketing',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'EmailMarketing',
			'width' => '5%',
		),
	 	'time_start'=>array(
	 		'usage'=>'query_only'
 		),
	),
);

?>