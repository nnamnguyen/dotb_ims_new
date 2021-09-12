<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings, $app_strings;
global $current_user;
$module_menu = array();
if ( isTouchScreen() ) {
    $module_menu[] = Array('index.php?module=Home&action=index', $mod_strings['LBL_MODULE_NAME'], 'Home', 'Home');
}
$module_menu[] = Array('index.php?module=Home&action=index&activeTab=AddTab', $app_strings['LBL_ADD_PAGE'], 'AddTab', 'Home');
?>