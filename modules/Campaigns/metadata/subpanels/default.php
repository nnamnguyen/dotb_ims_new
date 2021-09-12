<?php


$subpanel_layout = array(
	'top_buttons' => array(
       array('widget_class' => 'SubPanelTopCreateButton'),
	   array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Campaigns'),
	),

	'where' => '',

'list_fields' => array(
		'name'=>array(
	    'name' => 'name',
	 	'vname' => 'LBL_LIST_CAMPAIGN_NAME',
		'widget_class' => 'SubPanelDetailViewLink',
		'width' => '85%',
	   ),
        'status'=>array(
	 	    'name' => 'status',
	 	    'vname' => 'LBL_LIST_STATUS',
		    'width' => '15%',
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Campaigns',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Campgains',
			'width' => '5%',
		),
	),
);

?>