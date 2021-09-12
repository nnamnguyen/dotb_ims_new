<?php



$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Accounts'),
	),

	'where' => '',
	
	'list_fields' => array(
		'name' => array(
 		 	'vname' => 'LBL_LIST_ACCOUNT_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '45%',
		),
		'billing_address_city' => array(
 		 	'vname' => 'LBL_LIST_CITY',
			'width' => '27%',
		),
		'phone_office' => array(
 		 	'vname' => 'LBL_LIST_PHONE',
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