<?php

$dictionary['InboundEmail_autoreply'] = array ('table' => 'inbound_email_autoreply',
	'fields' => array (
		'id' => array (
			'name' => 'id',
			'vname' => 'LBL_ID',
			'type' => 'id',
			'required' => true,
			'reportable' => false,
		),
		'deleted' => array (
			'name' => 'deleted',
			'vname' => 'LBL_DELETED',
			'type' => 'bool',
			'required' => false,
			'default' => '0',
			'reportable'=>false,
		),
		'date_entered' => array (
			'name' => 'date_entered',
			'vname' => 'LBL_DATE_ENTERED',
			'type' => 'datetime',
			'required' => true,
		),
		'date_modified' => array (
			'name' => 'date_modified',
			'vname' => 'LBL_DATE_MODIFIED',
			'type' => 'datetime',
			'required' => true,
		),
		'autoreplied_to' => array (
			'name' => 'autoreplied_to',
			'vname' => 'LBL_AUTOREPLIED_TO',
			'type' => 'varchar',
			'len'		=> 100,
			'required' => true,
			'reportable'=>false,
		),
		'ie_id' => array(
			'name' => 'ie_id',
		    'vname' => 'LBL_INBOUNDEMAIL_ID',
			'type' => 'id',
		    'len' => '36',
		    'default' => '',
			'required' => true,
		    'reportable' => false,
		),
	),
	'indices' => array (
		array(
			'name' => 'ie_autopk',
			'type' =>'primary',
			'fields' => array(
				'id'
			)
		),
		array(
		'name' =>'idx_ie_autoreplied_to',
		'type'=>'index',
		'fields' => array(
			'autoreplied_to'
			)
		),
	), /* end indices */
	'relationships' => array (
	), /* end relationships */
);

?>
