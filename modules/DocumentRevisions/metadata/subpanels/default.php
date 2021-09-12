<?php


$subpanel_layout = array(
	'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateRevisionButton'),
	),

	'where' => '',


	'list_fields' => array(
		'filename'=>array (
			'vname'=>'LBL_REV_LIST_FILENAME',
			'widget_class' => 'SubPanelDetailViewLink',			
			'width' => '15%',
			),
        'revision'=>array(
 			'vname' => 'LBL_REV_LIST_REVISION',
			'width' => '5%',
		),
		'date_entered'=>array(
			'vname' => 'LBL_REV_LIST_ENTERED',
		    'width' => '10%',
		),
		'created_by_name'=>array(
	 		'vname' => 'LBL_REV_LIST_CREATED',
			'width' => '25%',
		),
		'change_log'=>array(
		 	'vname' => 'LBL_REV_LIST_LOG',
			'width' => '35%',
		),
		'del_button'=>array(
			'vname' => 'LBL_DELETE_BUTTON',
			'widget_class' => 'SubPanelRemoveButton',
			'width' => '5%',
		),
		'document_id'=>array(
			'usage' =>'query_only',
		)
	),
);
?>