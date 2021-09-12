<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
	),

	'where' => '',


	'list_fields' => array(
		'tracker_name'=>array(
	 		'vname' => 'LBL_SUBPANEL_TRACKER_NAME',
			'widget_class' => 'SubPanelDetailViewLink', 		
			'width' => '20%',
		),
		'tracker_url'=>array(
	 		'vname' => 'LBL_SUBPANEL_TRACKER_URL',
		 	'width' => '60%',
		),
		'tracker_key'=>array(
	 		'vname' => 'LBL_SUBPANEL_TRACKER_KEY',
			'width' => '10%',
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Cases',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Cases',
			'width' => '5%',
		),
	),
);
?>