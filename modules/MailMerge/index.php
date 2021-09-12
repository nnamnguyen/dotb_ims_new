<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $theme;
global $mod_strings;
global $current_language;
if(isset($_REQUEST['step']))
{
	$step = $_REQUEST['step'];
}
else
{
	$step = '1';
}
include ('modules/MailMerge/Step'. intval($step). '.php');
?>