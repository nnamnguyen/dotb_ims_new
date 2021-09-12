<?php


global $mod_strings;
global $current_user;
$actions = array('ModifyProperties', 'ModifyDisplay',
'ModifySearch',
'ModifyMapping', 'ConnectorSettings');
if(in_array($GLOBALS['action'], $actions)){
	$module_menu[]=Array("index.php?module=Connectors&action=ConnectorSettings", $mod_strings['LBL_ADMINISTRATION_MAIN'],"icon_Connectors");
	$module_menu[]=Array("index.php?module=Connectors&action=ModifyProperties", $mod_strings['LBL_MODIFY_PROPERTIES_TITLE'],"icon_ConnectorConfig_16");
	$module_menu[]=Array("index.php?module=Connectors&action=ModifyDisplay", $mod_strings['LBL_MODIFY_DISPLAY_TITLE'],"icon_ConnectorEnable_16");
	$module_menu[]=Array("index.php?module=Connectors&action=ModifyMapping", $mod_strings['LBL_MODIFY_MAPPING_TITLE'],"icon_ConnectorMap_16");


	$module_menu[]=Array("index.php?module=Connectors&action=ModifySearch", $mod_strings['LBL_MODIFY_SEARCH_TITLE'],"icon_ConnectorSearchFields_16");

}

if(!empty($_REQUEST['merge_module']) && ($GLOBALS['action'] == 'Step1' || $GLOBALS['action'] == 'Step2')) {
   $merge_module = $_REQUEST['merge_module'];
   $GLOBALS['mod_strings'] = return_module_language($GLOBALS['current_language'], $merge_module);
   foreach(DotbAutoLoader::existingCustom("modules/{$merge_module}/Menu.php") as $file) {
       require $file;
   }
   $GLOBALS['mod_strings'] = return_module_language($GLOBALS['current_language'], $GLOBALS['module']);
}
