<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/




global $mod_strings;
global $current_user;


if (!$GLOBALS['current_user']->isAdminForModule('Users')) dotb_die("Unauthorized access to administration.");

$focus = BeanFactory::newBean('Teams');

if(!isset($_REQUEST['team_record']) || !isset($_REQUEST['record'])) {
	dotb_die($mod_strings['ERR_DELETE_RECORD']);
}
else {
	$focus->retrieve($_REQUEST['team_record']);
}

$focus->remove_user_from_team($_REQUEST['record']);

header("Location: index.php?module={$_REQUEST['return_module']}&action={$_REQUEST['return_action']}&record={$_REQUEST['return_id']}");
?>
