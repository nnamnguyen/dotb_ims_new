<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
$module_name = 'C_Comments';
$_module_name = 'c_comments';
$searchFields['C_Comments'] =
	array (
		'document_name' => array( 'query_type'=>'default'),
        'category_id'=> array('query_type'=>'default', 'options' => 'document_category_dom', 'template_var' => 'CATEGORY_OPTIONS'),
        'subcategory_id'=> array('query_type'=>'default', 'options' => 'document_subcategory_dom', 'template_var' => 'SUBCATEGORY_OPTIONS'),
		'active_date'=> array('query_type'=>'default'),
		'exp_date'=> array('query_type'=>'default'),
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
	   'start_range_date_entered' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
	   'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
	   'start_range_date_modified' => array ('query_type' => 'default',  'enable_range_search' => true, 'is_date_field' => true),
       'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),	
	    //Range Search Support 	
	);
