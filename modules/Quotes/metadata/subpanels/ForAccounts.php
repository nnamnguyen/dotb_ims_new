<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Quotes'),
	),
	'list_fields' => array(
		'name'=>array(
			'vname' => 'LBL_LIST_QUOTE_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '40%',
		),
		'total_usdollar'=>array(
			'vname' => 'LBL_LIST_AMOUNT_USDOLLAR',
			'width' => '15%',
		),
		'date_quote_expected_closed'=>array(
			'name' => 'date_quote_expected_closed',
			'vname' => 'LBL_LIST_DATE_QUOTE_EXPECTED_CLOSED',
			'width' => '15%',
		),
		'assigned_user_name' => array (
			'name' => 'assigned_user_name',
			'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'target_record_key' => 'assigned_user_id',
			'target_module' => 'Employees',
			'width' => '15%',
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Quotes',
	 		'width' => '4%',
		),
		'currency_id'=>array(
			'usage'=>'query_only',
		),
	),
);
