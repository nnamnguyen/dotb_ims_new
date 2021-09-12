<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['EmailMarketing'] = array ('column_fields' => array (
		'id', 'date_entered', 'date_modified',
		'modified_user_id', 'created_by', 'name',
		'from_addr', 'from_name', 'reply_to_name', 'reply_to_addr', 'date_start','time_start', 'template_id', 'campaign_id','status','inbound_email_id','all_prospect_lists',
	),
        'list_fields' =>  array (
		'id','name','date_start','time_start', 'template_id', 'status','all_prospect_lists','campaign_id',
	),
    'required_fields' => array (
		'name'=>1, 'from_name'=>1,'from_addr'=>1, 'date_start'=>1,'time_start'=>1,
		'template_id'=>1, 'status'=>1,
	),
);
?>