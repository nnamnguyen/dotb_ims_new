<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

if(empty($fields_array['User'])){
	include('modules/Users/field_arrays.php');
}
$fields_array['Employee']=$fields_array['User'];
?>