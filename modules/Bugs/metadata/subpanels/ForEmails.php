<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Bugs'),
	),

	'where' => '',
	
	

	'list_fields' => array(
		'bug_number'=>array(
	 		'vname' => 'LBL_LIST_NUMBER',
	 		'width' => '5%',
		),
		
		'name'=>array(
	 		'vname' => 'LBL_LIST_SUBJECT',
			'widget_class' => 'SubPanelDetailViewLink',
	 		'width' => '50%',
		),
		'status'=>array(
	 		'vname' => 'LBL_LIST_STATUS',
	 		'width' => '15%',
		),
		'type'=>array(
	 		'vname' => 'LBL_LIST_TYPE',
	 		'width' => '15%',
		),
		'priority'=>array(
	 		'vname' => 'LBL_LIST_PRIORITY',
	 		'width' => '11%',
		),
		'edit_button'=>array(
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Bugs',
	 		'width' => '4%',
		),
		'remove_button'=>array(
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Bugs',
			'width' => '5%',
		),
	),
);

?>