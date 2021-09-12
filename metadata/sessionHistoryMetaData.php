<?php


$dictionary['session_history'] = array(
	'table' => 'session_history',
	'fields' => array (
		'id' => array(
			'name' => 'id', 
			'type' => 'id',
		),
		'session_id' => array(
			'name' => 'session_id',
			'type' => 'varchar',
			'len' => '100',
		),
		'date_entered' => array(
			'name' => 'date_entered',
			'type' => 'datetime',
		),
		'date_modified' => array (
			'name' => 'date_modified',
			'type' => 'datetime',
		),
		'last_request_time' => array(
			'name' => 'last_request_time',
			'type' => 'datetime',
		),
		'session_type' => array(
			'name' => 'session_type',
			'type' => 'varchar',
			'len' => '100',
		),
		'is_violation' => array(
			'name' => 'is_violation',
			'type' => 'bool',
			'len' => '1',
			'default'  => '0',
		),
		'num_active_sessions' => array(
			'name' => 'num_active_sessions',
			'type' => 'int',
			'default' => '0',
		),
		'deleted' => array(
			'name' => 'deleted',
			'type' => 'bool',
			'len' => '1',
			'default' => '0',
			'required' => false,
		)
	),
	'indices' => array(
		array(
			'name' => 'session_historypk',
			'type' => 'primary',
			'fields' => array('id'),
		),
	)
)

?>
