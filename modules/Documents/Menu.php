<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings;
global $current_user;


if(ACLController::checkAccess('Documents', 'edit', true))$module_menu[]=Array("index.php?module=Documents&action=EditView&return_module=Documents&return_action=DetailView", $mod_strings['LNK_NEW_DOCUMENT'],"CreateDocuments");
if(ACLController::checkAccess('Documents', 'list', true))$module_menu[]=Array("index.php?module=Documents&action=index", $mod_strings['LNK_DOCUMENT_LIST'],"Documents");
if(ACLController::checkAccess('Documents', 'edit', true)){
	
	$admin = Administration::getSettings();
	$user_merge = $current_user->getPreference('mailmerge_on');
	if ($user_merge == 'on' && isset($admin->settings['system_mailmerge_on']) && $admin->settings['system_mailmerge_on']){
		$module_menu[]=Array("index.php?module=MailMerge&action=index&reset=true", $mod_strings['LNK_NEW_MAIL_MERGE'],"Documents");
	}
}
?>
