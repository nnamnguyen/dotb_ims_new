<?php



$searchFields['RevenueLineItems'] = array (
    'name' => array (
        'query_type' => 'default',
        'force_unifiedsearch'=>true
    ),
    'account_name'=> array('query_type'=>'default','db_field'=>array('accounts.name')),
    'opportunity_name'=> array('query_type'=>'default','db_field'=>array('opportunities.name')),
    'best_case' => array (
        'query_type' => 'default'
    ),
    'likely_case' => array (
        'query_type' => 'default'
    ),
    'worst_case' => array (
        'query_type' => 'default'
    ),
    'probability' => array (
        'query_type' => 'default'
    ),
    'sales_stage' => array (
        'query_type' => 'default',
        'options' => 'sales_stage_dom',
        'template_var' => 'SALES_STAGE_OPTIONS',
        'options_add_blank' => true
    ),
    'type_id' => array (
        'query_type' => 'default',
        'options' => 'product_type_dom',
        'template_var' => 'TYPE_OPTIONS'
    ),
    'category_id' => array (
        'query_type' => 'default',
        'options' => 'products_cat_dom',
        'template_var' => 'CATEGORY_OPTIONS'
    ),
    'manufacturer_id' => array (
        'query_type' => 'default',
        'options' => 'manufacturer_dom',
        'template_var' => 'MANUFACTURER_OPTIONS'
    ),
    'favorites_only' => array (
        'query_type' => 'format',
        'operator' => 'subquery',
        'subquery' => 'SELECT dotbfavorites.record_id FROM dotbfavorites 
                                        WHERE dotbfavorites.deleted=0 
                                            and dotbfavorites.module = \'RevenueLineItems\'
                                            and dotbfavorites.assigned_user_id = \'{0}\'',
        'db_field' => array (
            'id'
        )
    ),
    //Range Search Support
    'range_date_entered' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'start_range_date_entered' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'end_range_date_entered' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'range_date_modified' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'start_range_date_modified' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'end_range_date_modified' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'range_date_closed' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'start_range_date_closed' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    'end_range_date_closed' => array (
        'query_type' => 'default',
        'enable_range_search' => true,
        'is_date_field' => true
    ),
    //Range Search Support
    
);
