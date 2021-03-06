<?php

$subpanel_layout = array(
	'top_buttons' => array(
	),

	'where' => '',


	'list_fields' => array(
		'recipient_name'=>array(
			'vname' => 'LBL_LIST_RECIPIENT_NAME',
			'width' => '10%',
			'sortable'=>false,			
		),
		'recipient_email'=>array(
			'vname' => 'LBL_LIST_RECIPIENT_EMAIL',
			'width' => '10%',
			'sortable'=>false,			
		),		
		'message_name' => array(
			'vname' => 'LBL_MARKETING_ID',
			'width' => '10%',
			'sortable'=>false,
		),
		'send_date_time' => array(
			'vname' => 'LBL_LIST_SEND_DATE_TIME',
			'width' => '10%',
			'sortable'=>false,			
		),
		'related_id'=>array(
			'usage'=>'query_only',
		),
		'related_type'=>array(
			'usage'=>'query_only',			
		),
		'marketing_id' => array(
			'usage'=>'query_only',			
		),
	),
);		
?>