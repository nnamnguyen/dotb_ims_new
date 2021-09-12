<?php

$searchFields['Contracts'] = 
    array (
        'name' => array( 'query_type'=>'default'),
        'account_name' => array( 'query_type'=>'default','db_field'=>array('accounts.name')),
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
        'status'=> array('query_type'=>'default', 'options' => 'contract_status_dom', 'template_var' => 'STATUS_OPTIONS', 'options_add_blank' => true),
        'start_date' => array( 'query_type'=>'default'),      
        'end_date' => array( 'query_type'=>'default'),      
        'assigned_user_id'=> array('query_type'=>'default'),
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
			                    WHERE dotbfavorites.deleted=0 
			                        and dotbfavorites.module = \'Contracts\' 
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

	   'range_customer_signed_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_customer_signed_date' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_customer_signed_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_company_signed_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_company_signed_date' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_company_signed_date' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
    
		//Range Search Support		
    );
?>
