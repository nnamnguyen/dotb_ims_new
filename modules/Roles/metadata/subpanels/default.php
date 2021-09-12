<?php


$subpanel_layout = array(
	'top_buttons' => array(
			array('widget_class' => 'SubPanelTopCreateButton'),
			array('widget_class' => 'SubPanelTopSelectButton'),
	),

	'where' => '',


	'list_fields' => array(
        'name'=>array(
		 	'vname' => 'LBL_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '9999%',
		),
		'description'=>array(
		 	'vname' => 'LBL_DESCRIPTION',
			'width' => '9999%',
		),
	),
);
?>