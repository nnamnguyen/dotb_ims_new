<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['Team'] = array (
	'column_fields' => array(
        'id',
		'date_entered',
		'date_modified',
		'modified_user_id',
		'created_by',
		'name',
		'description',
		'private',
	),
    'list_fields' =>  array(
    	'id', 
    	'name', 
    	'description', 
    	'description_head'
	),
	'export_fields' => array(
		'id',
		'name',
	    'name_2',
	    'associated_user_id',
	    'date_entered',
	    'date_modified',
	    'modified_user_id',
	    'created_by',
	    'private',
	    'description',
	    'deleted'
	),	
);
$fields_array['TeamMembership'] = array ('column_fields' => Array("id"
		,"team_id"
		,"user_id"
		,"explicit_assign"
		,"implicit_assign"
		,'date_modified'
		,"deleted"
		),
        'list_fields' =>  Array('id', "team_id", "user_id", "explicit_assign", "implicit_assign", 'date_modified'),
);
?>