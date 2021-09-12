<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings;
global $current_user;
$module_menu=Array();

if( empty($_REQUEST['record']) ) { $employee_id = ''; }
else { $employee_id = $_REQUEST['record']; }

if( is_admin($current_user) )
{
$module_menu[] = Array("index.php?module=Employees&action=EditView&return_module=Employees&return_action=DetailView", $mod_strings['LNK_NEW_EMPLOYEE'],"CreateEmployees");
}
	
$module_menu[] = Array("index.php?module=Employees&action=index&return_module=Employees&return_action=DetailView", $mod_strings['LNK_EMPLOYEE_LIST'],"Employees");


?>
