<?php

/*********************************************************************************
 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings, $current_user;
$module_menu  = Array();
if(ACLController::checkAccess('ContractTypes', 'edit', true) || (is_admin_for_module($current_user,'Contracts')))$module_menu[]=    Array("index.php?module=ContractTypes&action=EditView&return_module=ContractTypes&return_action=index", $mod_strings['LNK_NEW_CONTRACTTYPE'], "Contracts");
if(ACLController::checkAccess('ContractTypes', 'list', true) || (is_admin_for_module($current_user,'Contracts')))$module_menu[]=	Array("index.php?module=ContractTypes&action=index&return_module=ContractTypes&return_action=index", $mod_strings['LNK_CONTRACTTYPE_LIST'],"Contracts");
?>