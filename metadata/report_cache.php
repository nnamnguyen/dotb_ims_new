<?php


/**
 * table storing reports filter information */
$dictionary['report_cache'] = array(
	'table' => 'report_cache',
	'fields' => array(
		'id' => array(
			'name'		=> 'id',
			'type'		=> 'id',
			'required'	=> true,
		),
		'assigned_user_id' => array(
			'name'		=> 'assigned_user_id',
			'type'		=> 'id',
			'required'	=> true,
		),
		'contents' => array (
			'name'			=> 'contents',
			'type'			=> 'text',
			'comment'		=> 'contents of report object',
			'default'		=> NULL,
		),
		'report_options' => array (
			'name'			=> 'report_options',
			'type'			=> 'text',
			'comment'		=> 'options of report object like hide details, hide shart etc..',
			'default'		=> NULL,
		),
		'deleted' => array(
			'name'		=> 'deleted',
			'type'		=> 'varchar',
			'len'		=> 1,
			'required'	=> true,
		),
		'date_entered' => array (
			'name' => 'date_entered',
			'vname' => 'LBL_DATE_ENTERED',
			'type' => 'datetime',
			'required'=>true,
			'comment' => 'Date record created',
		),
		'date_modified' => array (
			'name' => 'date_modified',
			'vname' => 'LBL_DATE_MODIFIED',
			'type' => 'datetime',
			'required'=>true,
			'comment' => 'Date record last modified',
		),
	),
	'indices' => array(
		array(
			'name'			=> 'report_cache_pk',
			'type'			=> 'primary',
			'fields'		=> array('id', 'assigned_user_id')
		),
	),
);
