<?php

$searchFields['Bugs'] = 
	array (
		'name' => array( 'query_type'=>'default'),
        'status'=> array('query_type'=>'default', 'options' => 'bug_status_dom', 'template_var' => 'STATUS_OPTIONS'),
        'priority'=> array('query_type'=>'default', 'options' => 'bug_priority_dom', 'template_var' => 'PRIORITY_OPTIONS'),
		'found_in_release'=> array('query_type'=>'default','options' => 'bug_release_dom', 'template_var' => 'RELEASE_OPTIONS', 'options_add_blank' => true),
		'fixed_in_release'=> array('query_type'=>'default','options' => 'bug_release_dom', 'template_var' => 'RELEASE_OPTIONS', 'options_add_blank' => true),
        'resolution'=> array('query_type'=>'default', 'options' => 'bug_resolution_dom', 'template_var' => 'RESOLUTION_OPTIONS'),
		'bug_number'=> array('query_type'=>'default','operator'=>'in'),
		'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
		'assigned_user_id'=> array('query_type'=>'default'),
        'type'=> array('query_type'=>'default', 'options' => 'bug_type_dom', 'template_var' => 'TYPE_OPTIONS', 'options_add_blank' => true),
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
			                    WHERE dotbfavorites.deleted=0 
			                        and dotbfavorites.module = \'Bugs\' 
			                        and dotbfavorites.assigned_user_id = \'{0}\'',
			'db_field'=>array('id')),
		'open_only' => array(
			'query_type'=>'default',
			'db_field'=>array('status'),
			'operator'=>'not in',
			'closed_values' => array('Closed', 'Rejected'),
			'type'=>'bool',
		),
		//Range Search Support 
	    'range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	    'start_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	    'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	    'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	    'start_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
        'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
	    //Range Search Support 				
	);
?>
