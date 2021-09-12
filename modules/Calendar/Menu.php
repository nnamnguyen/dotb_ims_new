<?php




/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
global $mod_strings;
if(ACLController::checkAccess('Meetings', 'edit', true))$module_menu[]=Array("index.php?module=Meetings&action=EditView&return_module=Meetings&return_action=DetailView", $mod_strings['LNK_NEW_MEETING'],"CreateMeetings");
if(ACLController::checkAccess('Calls', 'edit', true))$module_menu[]=Array("index.php?module=Calls&action=EditView&return_module=Calls&return_action=DetailView", $mod_strings['LNK_NEW_CALL'],"CreateCalls");
if(ACLController::checkAccess('Tasks', 'edit', true))$module_menu[]=Array("index.php?module=Tasks&action=EditView&return_module=Tasks&return_action=DetailView", $mod_strings['LNK_NEW_TASK'],"CreateTasks");
if(ACLController::checkAccess('Calendar', 'list', true))$module_menu[]=Array("index.php?module=Calendar&action=index&view=day", $mod_strings['LNK_VIEW_CALENDAR'],"Calendar");


?>
