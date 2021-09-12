<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Meeting'] = array ('column_fields' => Array("id"
		, "date_entered"
		, "date_modified"
		, "assigned_user_id"
		, "modified_user_id"
		, "created_by"
		,"team_id"
		, "description"
		, "name"
		, "status"
		, "location"
		, "date_start"
		, "time_start"
		, "date_end"
		, "duration_hours"
		, "duration_minutes"
		, "parent_type"
		, "parent_id"
		, 'reminder_time'
		,'outlook_id'
		),
        'list_fields' =>  Array('id', 'location', 'duration_hours', 'name	', 'status', 'parent_type', 'parent_name', 'parent_id', 'date_start', 'time_start', 'assigned_user_name', 'assigned_user_id', 'contact_name', 'contact_id','first_name','last_name','required','accept_status','outlook_id','duration_minutes'
	, "team_id"
	, "team_name"
		),
    'required_fields' =>  array("name"=>1, "date_start"=>2, "time_start"=>3, "duration_hours"=>4),
);
?>