<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['Task'] = array ('column_fields' =>Array("id"
		, "date_entered"
		, "date_modified"
		, "assigned_user_id"
		, "modified_user_id"
		, "created_by"
		,"team_id"
		, "description"
		, "name"
		, "status"
		, "date_due"
		, "time_due"
		, "date_start_flag"
		, "date_start"
		, "time_start"
		, "priority"
		, "date_due_flag"
		, "parent_type"
		, "parent_id"
		, "contact_id"
		),
        'list_fields' =>  Array('id', 'status', 'name', 'parent_type', 'parent_name', 'parent_id', 'date_due', 'contact_id', 'contact_name', 'assigned_user_name', 'assigned_user_id','first_name','last_name','time_due', 'priority'
	, "team_id"
	, "team_name"
		),
    'required_fields' =>   array('name'=>1),
);
?>