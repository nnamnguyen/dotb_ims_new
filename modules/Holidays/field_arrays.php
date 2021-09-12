<?php

/*********************************************************************************
 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Holiday'] = array ('column_fields' => array (
		'id', 
		'date_entered', 
		'date_modified',
		'modified_user_id', 
		'created_by', 
		'holiday_date', 
		'description',
		'person_id',
		'person_type',
		'related_module_id',
		'related_module',
	),
        'list_fields' =>  array (
		'id',
		'holiday_date',
		'description',
		'person_id',
		'person_type',
		'related_module_id',
		'related_module',
	),
    'required_fields' =>   array (
		'holiday_date'=>1,
	),
);
?>