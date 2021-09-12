<?php

global $mod_strings,$app_strings;
if(ACLController::checkAccess('Cases', 'edit', true))
$module_menu [] = Array("index.php?module=Cases&action=EditView&return_module=Cases&return_action=DetailView", $mod_strings['LNK_NEW_CASE'],"CreateCases");
if(ACLController::checkAccess('Cases', 'list', true))
$module_menu [] = Array("index.php?module=Cases&action=index&return_module=Cases&return_action=DetailView", $mod_strings['LNK_CASE_LIST'],"Cases");
if(ACLController::checkAccess('Cases', 'list', true))$module_menu[] =Array("index.php?module=Reports&action=index&view=cases", $mod_strings['LNK_CASE_REPORTS'],"CaseReports", 'Cases');
if(ACLController::checkAccess('Cases', 'import', true))$module_menu[] =Array("index.php?module=Import&action=Step1&import_module=Cases&return_module=Cases&return_action=index", $mod_strings['LNK_IMPORT_CASES'],"Import", 'Cases');


?>