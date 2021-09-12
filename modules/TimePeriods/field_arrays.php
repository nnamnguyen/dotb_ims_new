<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['TimePeriod'] = array ('column_fields' =>Array("id"
		,"name"
		,"start_date"
		,"end_date"
		,"date_entered"
		,"date_modified"
		,"created_by"
		,"parent_id"
		,"is_fiscal_year"
		),
        'list_fields' =>  Array('id', 'name', 'start_date', 'end_date', 'parent_id', 'fiscal_year','is_fiscal_year','fiscal_year_checked'),
    'required_fields' =>   array("name"=>1, "status"=>2, "date_start"=>1, "date_end"=>2),
);
?>