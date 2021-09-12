<?php


$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Contracts','mode'=>'MultiSelect'),
	),

	'where' => '',
	
	

	'list_fields' => array(
		'name'=>array(
			'name'=>'name',		
			'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'module' => 'Contacts',
			'width' => '33%',
		),
		'start_date'=>array(
			'name'=>'start_date',		
			'vname' => 'LBL_LIST_START_DATE',
			'width' => '10%',
		),
		'end_date'=>array(
			'name'=>'end_date',		
			'vname' => 'LBL_LIST_END_DATE',
			'width' => '10%',
		),
		'status'=>array(
			'name'=>'status',		
			'vname' => 'LBL_LIST_STATUS',
			'width' => '10%',
		),
		'total_contract_value'=>array (
			'name'=>'total_contract_value',		
			'vname' => 'LBL_LIST_CONTRACT_VALUE',
			'width' => '15%',
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Contracts',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Contracts',
			'width' => '5%',
		),
	),
);		
?>
