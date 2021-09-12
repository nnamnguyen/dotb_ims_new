<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/

global $mod_strings;
$module_menu = Array(
	Array("index.php?module=WorkFlow&action=EditView&return_module=WorkFlow&return_action=DetailView", $mod_strings['LNK_NEW_WORKFLOW'],"CreateWorkflowDefinition"),
	Array("index.php?module=WorkFlow&action=index&return_module=WorkFlow&return_action=DetailView", $mod_strings['LNK_WORKFLOW'],"WorkFlow"),
	Array("index.php?module=WorkFlow&action=WorkFlowListView&return_module=WorkFlow&return_action=index", $mod_strings['LBL_ALERT_TEMPLATES'],"AlertEmailTemplates"),

	);

?>
