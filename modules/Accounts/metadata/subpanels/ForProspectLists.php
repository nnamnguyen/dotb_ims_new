<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Accounts'),
	),

	'where' => '',
	

	'list_fields' => array(
		'name' => array(
 		 	'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '25%',
		),
		'phone_office' => array(
 		 	'vname' => 'LBL_LIST_PHONE',
			'width' => '20%',
		),		
		'email' => array(
 		 	'vname' => 'LBL_LIST_EMAIL',
            'widget_class' => 'SubPanelEmailLink',
			'width' => '20%',
            'sortable' => false,
		),		
		'assigned_user_name' => array(
 		 	'vname' => 'LBL_ASSIGNED_TO',
			'width' => '20%',
		),
		'edit_button' => array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
			'width' => '4%',
		),
		'remove_button' => array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
			'width' => '4%',
		),
	),
);

?>