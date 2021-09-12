<?php

$subpanel_layout = array(
	'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
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
		 	'target_module' => 'Employees',
		 	'module' => 'Users',
			'target_module' => 'Employees',
		    'widget_class' => 'SubPanelDetailViewLink',
	 		'width' => '35%',
		),
		'email'=>array(
			'vname' => 'LBL_LIST_EMAIL',
			'widget_class' => 'SubPanelEmailLink',
			'width' => '35%',
            'sortable' => false,
		),
		'phone_work'=>array (
			'vname' => 'LBL_LIST_PHONE',
			'width' => '26%',
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