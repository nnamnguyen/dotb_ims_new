<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['Role'] = array ('column_fields' => array (
		'id', 'date_entered', 'date_modified',
		'modified_user_id', 'created_by', 'name',
		'description',
	),
        'list_fields' =>  array (
		'id','name','description',
	),
    'required_fields' =>   array (
		'name'=>1,
	),
);
?>