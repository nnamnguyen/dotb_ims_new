<?php


$subpanel_layout = array(
	'top_buttons' => array(
			/*array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Queues'),*/
	),
	'where' => "",

	'fill_in_additional_fields'=>true,
	'list_fields' => array(
		'name'			=> array (
			'vname'		=> 'LBL_NAME',
			'width'		=> '50%',
			'sortable'	=> false,
		),
		'status'		=> array (
			 'vname'	=> 'LBL_STATUS',
			 'width'	=> '10%',
			 'sortable'	=> true,
		),
		'execute_time'	=> array (
			 'vname'	=> 'LBL_EXECUTE_TIME',
			 'width'	=> '10%',
			 'sortable'	=> true,
		),
		'date_modified'	=> array (
			 'vname'	=> 'LBL_DATE_MODIFIED',
			 'width'	=> '10%',
			 'sortable'	=> true,
		),
		),
);

?>