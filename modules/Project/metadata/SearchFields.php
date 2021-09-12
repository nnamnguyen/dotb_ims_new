<?php

$searchFields['Project'] = 
    array (
        'name' => array( 'query_type'=>'default'),
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
        
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
			                    WHERE dotbfavorites.deleted=0 
			                        and dotbfavorites.module = \'Project\' 
			                        and dotbfavorites.assigned_user_id = \'{0}\'',
			'db_field'=>array('id')),
		//Range Search Support 
	   'range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_entered' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_modified' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
	    
	   'range_estimated_start_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_estimated_start_date' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_estimated_start_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_estimated_end_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_estimated_end_date' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_estimated_end_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
		//Range Search Support 				
    );
?>
