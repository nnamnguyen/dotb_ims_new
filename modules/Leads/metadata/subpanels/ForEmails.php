<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Accounts'),
	),

	'where' => '',
	
	

	'list_fields' => array(
		'first_name'=>array(
		 	'usage' => 'query_only',
		),
		'last_name'=>array(
		 	'usage' => 'query_only',
		),
		'salutation'=>array(
			'name'=>'salutation',
		 	'usage' => 'query_only',
		),
		'name'=>array(
			'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'module' => 'Leads',
			'width' => '20%',
		),
		'lead_source'=>array(
	 		'vname' => 'LBL_LIST_LEAD_SOURCE',
			'width' => '13%',
		),
		'email'=>array(
	 		'vname' => 'LBL_LIST_EMAIL_ADDRESS',
			'width' => '25%',
			'widget_class' => 'SubPanelEmailLink',
		),
		'lead_source_description'=>array(
	 		'name' => 'lead_source_description',
	 		'vname' => 'LBL_LIST_LEAD_SOURCE_DESCRIPTION',
			'width' => '26%',
			'sortable'=>false,
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Leads',
			'width' => '4%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Leads',
	 		'width' => '4%',
		),
	),
);

?>