<?php


$subpanel_layout = array(
	'top_buttons' => array(
       array('widget_class'=>'SubPanelTopCreateButton'),
			array('widget_class'=>'SubPanelTopSelectButton', 'popup_module' => 'ProspectLists', 'create'=>"true",'mode'=>'MultiSelect'),
		),

	'where' => '',


    'list_fields'=> array(
        'name' => array(
		 	'vname' => 'LBL_LIST_PROSPECT_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '37%',
		),
		'description' => array(
		 	'vname' => 'LBL_LIST_DESCRIPTION',
			'width' => '35%',
			'sortable'=>false,
		),
		'list_type' => array(
		 	'vname' => 'LBL_LIST_TYPE_NO',
			'width' => '10%',
		),
		'entry_count' => array(
		 	'vname' => 'LBL_LIST_ENTRIES',
			'width' => '8%',
			'sortable'=>false,
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'ProspectLists',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'ProspectLists',
			'width' => '5%',
		),
	),
);
?>