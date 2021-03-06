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
			'widget_class' => 'SubPanelConcat',
	 		'vname' => 'LBL_LIST_DATE_START',
		 	'width' => '20%',
		 	'source'=> array('date_start',' ','time_start'),
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
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'EmailMarketing',
			'width' => '5%',
		),
		'remove_button'=>array(
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