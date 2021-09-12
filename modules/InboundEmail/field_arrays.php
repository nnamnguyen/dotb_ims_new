<?php

$fields_array['InboundEmail'] = array (
	'column_fields' => array (
		'id',
		'deleted',
		'date_entered',
		'date_modified',
		'modified_user_id',
		'created_by',
		'name',
		'status',
		'server_url',
		'email_user',
		'email_password',
		'port',
		'service',
		'mailbox',
		'delete_seen',
		'mailbox_type',
		'template_id',
	),
	'list_fields' => array (
		'id',
		'name',
		'server_url',
		'status',
		'mailbox_type_name',
	),
	'required_fields' => array (
		'server_url' => 1,
		'service' => 1,
	),
);
?>
