<?php


$subpanel_layout = array(
	'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Users'),
	),

	'where' => '',
	
	

    'list_fields'=> array(
		'accept_status_name' => array(
			'vname' => 'LBL_LIST_ACCEPT_STATUS',
			'width' => '11%',
			'sortable'=> false,
		),
		'c_accept_status_fields'=>array(
			'usage' => 'query_only',
		),
		'accept_status_id'=>array(
			'usage' => 'query_only',
		),				
        'first_name'=>array(
		 	'usage' => 'query_only',
		),
		'last_name'=>array(
		 	'usage' => 'query_only',
		),
		'full_name'=>array(
			'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'target_module' => 'Employees',
		 	'module' => 'Users',
	 		'width' => '25%',
		),
		'user_name'=>array(
			'vname' => 'LBL_LIST_USER_NAME',
			'width' => '25%',
		),
		'email'=>array(
			'vname' => 'LBL_LIST_EMAIL',
			'width' => '20%',
			'widget_class' => 'SubPanelEmailLink',
            'sortable' => false,
		),
		'phone_work'=>array (
			'vname' => 'LBL_LIST_PHONE',
			'width' => '10%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButtonMeetings',
		 	'module' => 'Users',
			'width' => '10%',
			'linked_field' => 'users',
		),
	),
);

?>
