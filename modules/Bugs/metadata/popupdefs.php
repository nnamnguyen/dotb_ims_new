<?php


$popupMeta = array(
	'moduleMain' => 'Bug',
	'varName' => 'BUG',
	'orderBy' => 'bugs.name',
	'whereClauses' => array(
		'name' => 'bugs.name', 
		'bug_number' => 'bugs.bug_number'
	),
	'listviewdefs' => array(
		'BUG_NUMBER' => array(
			'width' => '5', 
			'label' => 'LBL_LIST_NUMBER', 
			'link' => true,
	        'default' => true), 
		'NAME' => array(
			'width' => '32', 
			'label' => 'LBL_LIST_SUBJECT', 
			'default' => true,
	        'link' => true),
	    'PRIORITY' => array(
	        'width' => '10', 
	        'label' => 'LBL_LIST_PRIORITY',
	        'default' => true),
		'STATUS' => array(
			'width' => '10', 
			'label' => 'LBL_LIST_STATUS',
	        'default' => true),
	    'TYPE' => array(
	        'width' => '10', 
	        'label' => 'LBL_LIST_TYPE',
	        'default' => true), 
	    'PRODUCT_CATEGORY' => array(
	        'width' => '10', 
	        'label' => 'LBL_PRODUCT_CATEGORY',
	        'default' => true), 
	    'ASSIGNED_USER_NAME' => array(
			'width' => '9', 
			'label' => 'LBL_LIST_ASSIGNED_USER',
	        'default' => true)
	      
	),
	'searchdefs'   => array(
	 	'bug_number', 
		'name', 
		'priority',
		'status',
		'type',
		'product_category',
		array('name' => 'assigned_user_id', 'type' => 'enum', 'label' => 'LBL_ASSIGNED_TO', 'function' => array('name' => 'get_user_array', 'params' => array(false))),
	)
);