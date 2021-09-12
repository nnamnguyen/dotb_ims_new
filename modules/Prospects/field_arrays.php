<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Prospect'] = array ('column_fields' => Array("id"
		,"date_entered"
		,"date_modified"
		,"modified_user_id"
		,"assigned_user_id"
		, "created_by"
		,"team_id"
		,"salutation"
		,"first_name"
		,"last_name"
		,"title"
		,"department"
		,"birthdate"
		,"do_not_call"
		,"phone_home"
		,"phone_mobile"
		,"phone_work"
		,"phone_other"
		,"phone_fax"
		,"email1"
		,"email2"
		,"assistant"
		,"assistant_phone"
		,"email_opt_out"
		,"primary_address_street"
		,"primary_address_city"
		,"primary_address_state"
		,"primary_address_postalcode"
		,"primary_address_country"
		,"alt_address_street"
		,"alt_address_city"
		,"alt_address_state"
		,"alt_address_postalcode"
		,"alt_address_country"
		,"description"
		,"tracker_key"
		,'invalid_email'
		,'lead_id'
		,'account_name'
		),
        'list_fields' =>  Array('full_name','id', 'first_name', 'last_name', 'account_name', 'account_id', 'title', 'email1','email2', 'phone_work', 'assigned_user_name', 'assigned_user_id','email_and_name1','email_and_name2'
	, "team_id"
	, "team_name"
,'invalid_email'
,'lead_id'
		),
    'required_fields' =>   array("last_name"=>1),
);
?>