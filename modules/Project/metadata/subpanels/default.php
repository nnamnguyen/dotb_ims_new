<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Accounts'),
	),

	'where' => '',
	
	
	'fill_in_additional_fields'=>true,
	'list_fields' => array(
		'name'=>array(
	 		'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '35%',
		),
		'assigned_user_name'=>array(
	 		'vname' => 'LBL_LIST_ASSIGNED_USER_ID',
			'widget_class' => 'SubPanelDetailViewLink',
	 		'module' => 'Users',
	 		'target_record_key' => 'assigned_user_id',
 		 	'target_module' => 'Users',
			'width' => '15%',
			 'sortable'=>false,	
		),
		'estimated_start_date' => array(
			'vname' => 'LBL_DATE_START',
			'width' => '25%',
			'sortable' => true,
		),
		'estimated_end_date' => array(
			'vname' => 'LBL_DATE_END',
			'width' => '25%',
			'sortable' => true,
		),		
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
			'module' => 'Project',
		 	'width' => '3%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
 		 	'module' => 'Project',
	 		'width' => '3%',
		),				
	),
);

?>