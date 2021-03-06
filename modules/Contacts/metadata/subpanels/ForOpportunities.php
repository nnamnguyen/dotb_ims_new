<?php



$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Contacts'),
	),

	'where' => '',



	'list_fields' => array(
		'first_name'=>array(
			'name'=>'first_name',
			'usage' => 'query_only',
		),
		'last_name'=>array(
			'name'=>'last_name',
		 	'usage' => 'query_only',
		),
		'salutation'=>array(
			'name'=>'salutation',
		 	'usage' => 'query_only',
		),
		'name'=>array(
			'name'=>'name',
			'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'module' => 'Contacts',
			'width' => '23%',
		),
		'account_name'=>array(
			'name'=>'account_name',
		 	'module' => 'Accounts',
		 	'target_record_key' => 'account_id',
		 	'target_module' => 'Accounts',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'vname' => 'LBL_LIST_ACCOUNT_NAME',
			'width' => '22%',
			'sortable'=>false,
		),
		'account_id'=>array(
			'usage'=>'query_only',

		),
		'opportunity_role_fields'=>array(
			'usage' => 'query_only',
		),
		'opportunity_role_id'=>array(
			'usage' => 'query_only',
		),
		'opportunity_role'=>array(
			'name'=>'opportunity_role',
			'vname' => 'LBL_LIST_CONTACT_ROLE',
			'width' => '10%',
			'sortable'=>false,
		),
		'email'=>array(
			'name'=>'email',
			'vname' => 'LBL_LIST_EMAIL',
			'widget_class' => 'SubPanelEmailLink',
			'width' => '30%',
			'sortable' => false,
		),

		'phone_work'=>array (
			'name'=>'phone_work',
			'vname' => 'LBL_LIST_PHONE',
			'width' => '15%',
		),
		//kbrill Bug#17483
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
		    //'widget_class' => 'SubPanelEditButton', 
		    //C.L. Bug#18035, changed to use SubPanelEditRoleButton
			'widget_class' => 'SubPanelEditRoleButton',
			'role_id'=>'opportunity_role_id',
		 	'module' => 'Contacts',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Contacts',
			'width' => '5%',

		),


	),
);
?>