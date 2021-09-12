<?php

$searchFields['Tasks'] = 
	array (
		'name' => array( 'query_type'=>'default'),
        'contact_name' => array('query_type' => 'default', 'db_field' => array('contacts.first_name', 'contacts.last_name'), 'force_unifiedsearch' => true),        
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
        'assigned_user_id'=> array('query_type'=>'default'),
        'status'=> array('query_type'=>'default', 'options' => 'task_status_dom', 'template_var' => 'STATUS_FILTER'),
        
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
			                    WHERE dotbfavorites.deleted=0 
			                        and dotbfavorites.module = \'Tasks\'
			                        and dotbfavorites.assigned_user_id = \'{0}\'',
			'db_field'=>array('id')),
		'open_only' => array(
			'query_type'=>'default',
			'db_field'=>array('status'),
			'operator'=>'not in',
			'closed_values' => array('Completed', 'Deferred'),
			'type'=>'bool',
		),				
		//Range Search Support 
	   'range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_entered' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_modified' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	

	   'range_date_start' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_start' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_date_start' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_date_due' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_due' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_date_due' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
		//Range Search Support 				
	);
?>
