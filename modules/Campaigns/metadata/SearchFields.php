<?php

$searchFields['Campaigns'] = 
    array (
        'name' => array( 'query_type'=>'default'),
        'campaign_type'=> array('query_type'=>'default', 'options' => 'campaign_type_dom', 'template_var' => 'TYPE_OPTIONS'),
        'status'=> array('query_type'=>'default', 'options' => 'campaign_status_dom', 'template_var' => 'STATUS_OPTIONS'),
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
        'assigned_user_id'=> array('query_type'=>'default'),
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
			                    WHERE dotbfavorites.deleted=0 
			                        and dotbfavorites.module = \'Campaigns\' 
			                        and dotbfavorites.assigned_user_id = {0}',
			'db_field'=>array('id')),
		
       //Range Search Support 
	   'range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_entered' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_modified' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
	    
	   'range_start_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_start_date' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_start_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_end_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_end_date' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_end_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	

	   'range_amount' => array ('query_type' => 'default', 'enable_range_search' => true),
	   'start_range_amount' => array ('query_type' => 'default',  'enable_range_search' => true),
       'end_range_amount' => array ('query_type' => 'default', 'enable_range_search' => true),	
       //Range Search Support 
    );
?>
