<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['Note'] = array ('column_fields' => Array("id"
		, "date_entered"
		, "date_modified"
		, "modified_user_id"
		, "created_by"
		, "description"
		, "name"
		, "filename"
		, "file_mime_type"
		, "parent_type"
		, "parent_id"
		, "contact_id"
		, "portal_flag"
		,"team_id"
		),
        'list_fields' =>  Array('id', 'name', 'parent_type', 'parent_name', 'parent_id','date_modified', 'contact_id', 'contact_name','filename','file_mime_type'
	, "team_id"
	),
    'required_fields' =>  array("name"=>1),
);
?>