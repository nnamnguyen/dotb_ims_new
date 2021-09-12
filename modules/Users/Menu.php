<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;

$idpConfig = new Config(\DotbConfig::getInstance());

global $mod_strings, $app_strings;
global $current_user, $dotb_config;

$module_menu=Array();
if($GLOBALS['current_user']->isAdminForModule('Users')
)
{

	$module_menu = Array(
		Array("index.php?module=Users&action=EditView&return_module=Users&return_action=DetailView", $mod_strings['LNK_NEW_USER'],"CreateUsers"),
		Array("index.php?module=Users&action=EditView&usertype=group&return_module=Users&return_action=DetailView", $mod_strings['LNK_NEW_GROUP_USER'],"CreateUsers")
	);


	if (isset($dotb_config['enable_web_services_user_creation']) && $dotb_config['enable_web_services_user_creation']) {
		$module_menu[] = Array("index.php?module=Users&action=EditView&usertype=portal&return_module=Users&return_action=DetailView", $mod_strings['LNK_NEW_PORTAL_USER'],"CreateUsers");
	}
	$module_menu[] = Array("index.php?module=Users&action=EditView&usertype=portal&return_module=Users&return_action=DetailView", $mod_strings['LNK_NEW_PORTAL_USER'],"CreateUsers");
	$module_menu[] = Array("index.php?module=Users&action=ListView&return_module=Users&return_action=DetailView", $mod_strings['LNK_USER_LIST'],"Users");

	$module_menu[] = Array("index.php?module=Users&action=reassignUserRecords", $mod_strings['LNK_REASSIGN_RECORDS'],"ReassignRecords");
    if (!$idpConfig->isIDMModeEnabled()) {
        $module_menu[] = [
            "index.php?module=Import&action=Step1&import_module=Users&return_module=Users&return_action=index",
            $mod_strings['LNK_IMPORT_USERS'],
            "Import",
            'Contacts',
        ];
    }
}
/*
	array_push($module_menu, Array("index.php?module=Users&action=EditTabs&return_module=Users&return_action=DetailView", $mod_strings['LNK_EDIT_TABS'],"Users"))
*/
?>
