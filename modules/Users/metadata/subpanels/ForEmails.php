<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Users'),
	),

	'where' => '',
	
	

    'list_fields'=> array(
        'first_name'=>array(
		 	'usage' => 'query_only',
		),
		'last_name'=>array(
		 	'usage' => 'query_only',
		),
		'name'=>array(
			'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'module' => 'Users',
		 	'target_module' => 'Employees',
	 		'width' => '25%',
		),
		'user_name'=>array(
			'vname' => 'LBL_LIST_USER_NAME',
			'width' => '25%',
		),
		'email'=>array(
			'vname' => 'LBL_LIST_EMAIL',
			'width' => '25%',
            'sortable' => false,
		),
		'phone_work'=>array (
			'vname' => 'LBL_LIST_PHONE',
			'width' => '21%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Users',
			'width' => '4%',
			'linked_field' => 'users',
		),
	),
);

?>