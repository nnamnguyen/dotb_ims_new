<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 ********************************************************************************/
$fields_array['Lead'] = array ('column_fields' => Array("id"
		,"refered_by"
		,"date_entered"
		,"date_modified"
		,"modified_user_id"
		,"assigned_user_id"
		, "created_by"
		,"team_id"
		,"salutation"
		,"first_name"
		,"last_name"
		,"lead_source"
		,"lead_source_description"
		,"title"
		,"department"
		,"reports_to_id"
		,"do_not_call"
		,"phone_home"
		,"phone_mobile"
		,"phone_work"
		,"phone_other"
		,"phone_fax"
		,"email1"
		,"email2"
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
		,"status"
		,"status_description"
		,"account_name"
		,"account_description"
		,"account_id"
		,"opportunity_id"
		,"contact_id"
		,"opportunity_amount"
		,"opportunity_name"
		,"portal_name"
		,"portal_app"
		,"invalid_email"
		,"campaign_id"
		),
        'list_fields' =>  Array('id', 'first_name', 'last_name', 'account_name', 'title', 'email1', 'phone_work', 'assigned_user_name', 'assigned_user_id', 'lead_source', 'lead_source_description', 'refered_by', 'opportunity_name', 'opportunity_amount', 'date_entered', 'status'
		, "team_id"
		, "team_name"
		,'invalid_email'
		, "campaign_id"
		),
    'required_fields' =>  array("last_name"=>1),
);
?>