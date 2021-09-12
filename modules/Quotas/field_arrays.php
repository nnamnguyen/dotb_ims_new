<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Quota'] = array ('column_fields' => Array("id"
		,"user_id"
		,"timeperiod_id"
		,"quota_type"
		,"amount"
		,"amount_base_currency"
		,"currency_id"
        ,"committed"
		,"date_entered"
		,"date_modified"
		,"modified_user_id"
		,"created_by"
		),
        'list_fields' =>  Array('id'),
    'required_fields' =>  array("user_id"=>1, "amount"=>2, "currency_id"=>3),
);
?>