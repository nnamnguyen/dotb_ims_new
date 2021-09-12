<?php

/*********************************************************************************
 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['ContractType'] = array ('column_fields' => array(
		"id"
		,"name"
		,"list_order"
		,"date_entered"
		,"date_modified"
		,"modified_user_id"
		, "created_by"
		),
        'list_fields' =>  array('id', 'name', 'list_order'),
    'required_fields' =>  array("name"=>1, "list_order"=>2),
);
?>