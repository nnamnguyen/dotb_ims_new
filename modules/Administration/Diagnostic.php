<?php





global $mod_strings;
global $app_list_strings;
global $app_strings;

global $current_user;

if (!is_admin($current_user)) dotb_die("Unauthorized access to administration.");
if (isset($GLOBALS['dotb_config']['hide_admin_diagnostics']) && $GLOBALS['dotb_config']['hide_admin_diagnostics'])
{
    dotb_die("Unauthorized access to diagnostic tool.");
}

global $db;
if(empty($db)) {
	
	$db = DBManagerFactory::getInstance();
}

echo getClassicModuleTitle(
        "Administration", 
        array(
            "<a href='index.php?module=Administration&action=index'>{$mod_strings['LBL_MODULE_NAME']}</a>",
           translate('LBL_DIAGNOSTIC_TITLE')
           ), 
        false
        );

global $currentModule;

$GLOBALS['log']->info("Administration Diagnostic");

$dotb_smarty = new Dotb_Smarty();
$dotb_smarty->assign("MOD", $mod_strings);
$dotb_smarty->assign("APP", $app_strings);

$dotb_smarty->assign("RETURN_MODULE", "Administration");
$dotb_smarty->assign("RETURN_ACTION", "index");
$dotb_smarty->assign("DB_NAME", $db->dbName);

$dotb_smarty->assign("MODULE", $currentModule);

$dotb_smarty->assign("ADVANCED_SEARCH_PNG", DotbThemeRegistry::current()->getImage('advanced_search','border="0"',null,null,'.gif',$app_strings['LNK_ADVANCED_SEARCH']));
$dotb_smarty->assign("BASIC_SEARCH_PNG", DotbThemeRegistry::current()->getImage('basic_search','border="0"',null,null,'.gif',$app_strings['LNK_BASIC_SEARCH']));

$dotb_smarty->display("modules/Administration/Diagnostic.tpl");
