<?php



global $mod_strings;
global $current_user;

$module_menu = Array(

	Array("index.php?module=Holidays&action=EditView&return_module=Holidays&return_action=index", $mod_strings['LNK_NEW_HOLIDAY'],"CreateHolidays"),

);

if (is_admin($current_user)){
	array_push($module_menu, Array("index.php?module=Holidays&action=index", $mod_strings['LNK_HOLIDAYS'],"Holidays"));
}

?>