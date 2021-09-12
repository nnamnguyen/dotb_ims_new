<?php

$module_name = 'J_Discount';
$searchFields[$module_name] = 
	array (
		'name' => array( 'query_type'=>'default'),
		'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
		'assigned_user_id'=> array('query_type'=>'default'),
		'favorites_only' => array(
            'query_type'=>'format',
			'operator' => 'subquery',
			'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
			                    WHERE dotbfavorites.deleted=0 
			                        and dotbfavorites.module = \''.$module_name.'\'
			                        and dotbfavorites.assigned_user_id = \'{0}\'',
			'db_field'=>array('id')),
	    
		//Range Search Support 
	   'range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
       'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
	    //Range Search Support
        'product_discount' => array (
            'db_field' =>
                array (
                    0 => 'id',
                ),
            'query_type' => 'format',
            'operator' => 'subquery',
            'subquery' => 'SELECT product_templates_discount.discount_id FROM product_templates_discount
                           INNER JOIN j_discount ON j_discount.id = product_templates_discount.discount_id AND j_discount.deleted = 0
                           WHERE product_templates_discount.deleted = 0 AND product_templates_discount.product_templates_id IN ({0})',
        ),
	);
