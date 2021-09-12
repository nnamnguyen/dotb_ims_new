<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Bug'] = array ('column_fields' => Array("id"
		, "name"
		, "bug_number"
		, "date_entered"
		, "date_modified"
		, "modified_user_id"
		, "assigned_user_id"
		,"team_id"
		, "status"
		, "found_in_release"
		, "created_by"
		, "resolution"
		, "priority"
		, "description"
		,'type'
		, "fixed_in_release"
		, "work_log"
		, "source"
		, "product_category"
		),
        'list_fields' => Array('id', 'priority', 'status', 'name', 'bug_number', 'assigned_user_name', 'assigned_user_id', 'release', 'found_in_release', 'resolution', 'type'
	, "team_id"
	, "team_name"
		),
        'required_fields' => array('name'=>1),
);
?>