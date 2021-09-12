<?php


$subpanel_layout = array(
	'top_buttons' => array(
        	array('widget_class'=>'SubPanelTopCreateButton'),
			array('widget_class'=>'SubPanelTopSelectButton', 'popup_module' => 'Meetings'),
		),

	'where' => '',


	'list_fields' => array(
        'name'=>array(
		    'name' => 'name',
		 	'vname' => 'LBL_LIST_SUBJECT',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '50%',
		),
		'date_start'=>array(
		    'name' => 'date_start',
		 	'vname' => 'LBL_LIST_DATE',
			'width' => '25%',
		),
		'date_end'=>array(
		    'name' => 'date_end',
		    'vname' => 'LBL_DATE_END',
		    'width' => '25%',
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			 'widget_class' => 'SubPanelEditButton',
			 'width' => '2%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			 'widget_class' => 'SubPanelRemoveButton',
			 'width' => '2%',
		),
		'recurring_source'=>array(
			'usage'=>'query_only',	
		),
	),
);
?>
