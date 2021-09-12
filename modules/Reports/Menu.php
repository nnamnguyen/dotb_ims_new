<?php


global $mod_strings;
global $current_language;
$module_menu = Array(

    Array("index.php?module=Reports&report_module=&action=index&page=report&Create+Custom+Report=Create+Custom+Report", $mod_strings['LBL_CREATE_REPORT'],"CreateReport", 'Reports'),
    //Array("index.php?module=Reports&favorite=1&action=index", $mod_strings['LBL_FAVORITE_REPORTS'], "FavoriteReports", 'Reports'),
    Array("index.php?module=Reports&action=index", $mod_strings['LBL_ALL_REPORTS'],"Reports", 'Reports'),
	);

if(!(ACLController::checkAccess('Reports', 'edit', true)))
{
    $module_menu = Array(
    Array("index.php?module=Reports&favorite=1&action=index", $mod_strings['LBL_FAVORITE_REPORTS'], "FavoriteReports", 'Reports'),
    Array("index.php?module=Reports&action=index", $mod_strings['LBL_ALL_REPORTS'],"Reports", 'Reports'),
    );
}

?>
