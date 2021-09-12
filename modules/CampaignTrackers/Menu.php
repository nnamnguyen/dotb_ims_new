<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings;
$module_menu  = Array();
if(ACLController::checkAccess('Campaigns', 'list', true))$module_menu[]=	Array("index.php?module=Campaigns&action=index&return_module=Campaigns&return_action=index", $mod_strings['LNK_CAMPAIGN_LIST'],"Campaigns");
?>