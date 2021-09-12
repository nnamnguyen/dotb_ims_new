<?php



global $mod_strings, $app_strings;

if(ACLController::checkAccess('Notes', 'edit', true))$module_menu[]=Array("index.php?module=Notes&action=EditView&return_module=Notes&return_action=DetailView", $mod_strings['LNK_NEW_NOTE'],"CreateNotes");
if(ACLController::checkAccess('Notes', 'list', true))$module_menu[]=Array("index.php?module=Notes&action=index&return_module=Notes&return_action=DetailView", $mod_strings['LNK_NOTE_LIST'],"Notes");
if(ACLController::checkAccess('Notes', 'import', true))$module_menu[]=Array("index.php?module=Import&action=Step1&import_module=Notes&return_module=Notes&return_action=index", $mod_strings['LNK_IMPORT_NOTES'],"Import", 'Notes');

?>