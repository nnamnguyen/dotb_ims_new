<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['EmailTemplate'] = array ('column_fields' => Array("id"
		, "date_entered"
		, "date_modified"
		, "modified_user_id"
		, "created_by"
		, "description"
		, "subject"
		, "body"
		, "body_html"
		, "name"
		, "published"
		,"team_id"
		,"team_name"
		,"base_module"
		,"from_name"
		,"from_address"
		),
        'list_fields' =>  Array('id', 'name', 'description','date_modified'
	, "team_id"
	),
    'required_fields' => array("name"=>1),
);
?>