<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings, $app_strings, $dotb_config;
$module_menu = Array();
if(ACLController::checkAccess('Opportunities','edit',true)){
	$module_menu[]=	Array("index.php?module=Opportunities&action=EditView&return_module=Opportunities&return_action=DetailView", $mod_strings['LNK_NEW_OPPORTUNITY'],"CreateOpportunities");
}
if(ACLController::checkAccess('Opportunities','list',true)){
	$module_menu[]=	Array("index.php?module=Opportunities&action=index&return_module=Opportunities&return_action=DetailView", $mod_strings['LNK_OPPORTUNITY_LIST'],"Opportunities");
}

if (ACLController::checkAccess('Opportunities', 'view', true)) {
    $module_menu[] = array(
        'index.php?module=Reports&action=index&view=opportunities',
        $mod_strings['LNK_OPPORTUNITY_REPORTS'],
        'OpportunityReports',
        'Opportunities',
    );
}

if(ACLController::checkAccess('Opportunities','import',true)){
	$module_menu[]=  Array("index.php?module=Import&action=Step1&import_module=Opportunities&return_module=Opportunities&return_action=index", $mod_strings['LNK_IMPORT_OPPORTUNITIES'],"Import");
}
