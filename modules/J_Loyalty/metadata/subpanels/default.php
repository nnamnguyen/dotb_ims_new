<?php


$module_name='J_Loyalty';
$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => $module_name),
	),

	'where' => '',

	'list_fields' => array(
	     'name' =>
        array (
            'vname' => 'LBL_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '20%',
            'default' => true,
        ),
        'student_name' =>
        array (
            'type' => 'relate',
            'link' => true,
            'vname' => 'LBL_STUDENT_NAME',
            'id' => 'STUDENT_ID',
            'width' => '10%',
            'default' => true,
            'widget_class' => 'SubPanelDetailViewLink',
            'target_module' => 'Contacts',
            'target_record_key' => 'student_id',
        ),
        'type' =>
        array (
            'vname' => 'LBL_TYPE',
            'width' => '10%',
        ),
        'point' =>
        array (
            'vname' => 'LBL_POINT',
            'width' => '10%',
            'default' => true,
        ),
        'input_date' =>
        array (
            'vname' => 'LBL_INPUT_DATE',
            'width' => '10%',
            'default' => true,
        ),
        'description' =>
        array (
            'vname' => 'LBL_DESCRIPTION',
            'width' => '15%',
            'default' => true,
        ),
        'created_by_name' =>
        array (
            'type' => 'relate',
            'link' => true,
            'vname' => 'LBL_CREATED',
            'id' => 'CREATED_BY',
            'width' => '10%',
            'default' => true,
            'widget_class' => 'SubPanelDetailViewLink',
            'target_module' => 'Users',
            'target_record_key' => 'created_by',
        ),
	),
);

?>