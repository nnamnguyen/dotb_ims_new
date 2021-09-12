<?php

$searchFields['EmailMan'] = 
	array (
		'campaign_name' => array( 'query_type'=>'default','db_field'=>array('campaigns.name')),
		'to_name'=> array('query_type'=>'default','db_field'=>array('contacts.first_name','contacts.last_name','leads.first_name','leads.last_name','prospects.first_name','prospects.last_name')),
        'to_email'=> array('query_type'=>'default','db_field'=>array('contacts.email1','leads.email1','prospects.email1')),
        'current_user_only'=> array('query_type'=>'default','db_field'=>array('assigned_user_id'),'my_items'=>true, 'vname' => 'LBL_CURRENT_USER_FILTER', 'type' => 'bool'),
	);
?>
