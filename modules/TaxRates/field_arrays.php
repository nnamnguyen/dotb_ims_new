<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['TaxRate'] = array ('column_fields' =>Array("id"
		,"name"
		,"value"
		,"list_order"
		,"date_entered"
		,"date_modified"
		,"status"
		,"modified_user_id"
		, "created_by"
		),
        'list_fields' =>  Array('id', 'name', 'list_order', 'status'),
    'required_fields' =>   array("name"=>1,'list_order'=>1,'status'=>1, 'value'=>1),
);
?>