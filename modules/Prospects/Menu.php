<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings, $app_strings;

if(ACLController::checkAccess('Prospects', 'edit', true))$module_menu[]=	Array("index.php?module=Prospects&action=EditView&return_module=Prospects&return_action=DetailView", $mod_strings['LNK_NEW_PROSPECT'],"CreateProspects");
if(ACLController::checkAccess('Prospects', 'list', true))$module_menu[]=	Array("index.php?module=Prospects&action=index&return_module=Prospects&return_action=index", $mod_strings['LNK_PROSPECT_LIST'],"Prospects");
if(ACLController::checkAccess('Prospects', 'import', true))$module_menu[]=  Array("index.php?module=Import&action=Step1&import_module=Prospects&return_module=Prospects&return_action=index", $mod_strings['LNK_IMPORT_PROSPECTS'],"Import");