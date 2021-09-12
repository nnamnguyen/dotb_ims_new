<?php


$module_name='EAPM';
$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
	),

	'where' => '',

	'list_fields' => array(
		'application'=>array(
	 		'vname' => 'LBL_APPLICATION',
			'widget_class' => 'SubPanelDetailViewLink',
	 		'width' => '25%',
		),
		'name'=>array(
	 		'vname' => 'LBL_NAME',
	 		'width' => '20%',
		),
		'date_modified'=>array(
	 		'vname' => 'LBL_DATE_MODIFIED',
	 		'width' => '20%',
		),
	),
);

?>
