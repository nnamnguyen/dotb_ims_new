<?php


$searchFields['Quotas'] =
array (
    'forecast_type' => array( 'query_type'=>'default'),
    'user_id' => array ( 'query_type'=>'default'),
    'timeperiod_id' => array ( 'query_type'=>'default'),
    //Range Search Support
    'range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
    'start_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
    'end_range_date_entered' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
    'range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
    'start_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
    'end_range_date_modified' => array ('query_type' => 'default', 'enable_range_search' => true, 'is_date_field' => true),
    //Range Search Support
);