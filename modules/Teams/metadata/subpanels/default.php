<?php


$subpanel_layout = array(
	'buttons' => array(
            array('widget_class' => 'SubPanelTopCreateButton'),
			array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Teams'),
	),

	'where' => '',


	'list_fields' => array(
        array(
		    'name' => 'name',
		 	'vname' => 'LBL_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '9999%',
		),
		array(
		    'name' => 'description',
		 	'vname' => 'LBL_DESCRIPTION',
			'width' => '9999%',
		)
	),
);
?>