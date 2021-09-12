<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings,$app_strings;
if(ACLController::checkAccess('Bugs', 'edit', true))
$module_menu [] =	Array("index.php?module=Bugs&action=EditView&return_module=Bugs&return_action=DetailView", $mod_strings['LNK_NEW_BUG'],"CreateBugs", 'Bugs');
if(ACLController::checkAccess('Bugs', 'list', true))
$module_menu [] =		Array("index.php?module=Bugs&action=index&return_module=Bugs&return_action=DetailView", $mod_strings['LNK_BUG_LIST'],"Bugs", 'Bugs');
if(ACLController::checkAccess('Bugs', 'list', true))$module_menu[] =Array("index.php?module=Reports&action=index&view=bugs", $mod_strings['LNK_BUG_REPORTS'],"BugReports", 'Bugs');
if(ACLController::checkAccess('Bugs', 'import', true))$module_menu[] =Array("index.php?module=Import&action=Step1&import_module=Bugs&return_module=Bugs&return_action=index", $mod_strings['LNK_IMPORT_BUGS'],"Import", 'Bugs');

?>