<?php

/*********************************************************************************

 * Description:  controls which link show up in the upper right hand corner of the app
 ********************************************************************************/

global $app_strings, $current_user;
global $dotb_config, $dotb_version, $dotb_flavor, $server_unique_key, $current_language, $action;

 if(!isset($global_control_links)){
 	$global_control_links = array();
	$sub_menu = array();
 }

if(DotbThemeRegistry::current()->name != 'Classic')
$global_control_links['profile'] = array(
'linkinfo' => array($app_strings['LBL_PROFILE'] => 'index.php?module=Users&action=EditView&record='.$GLOBALS['current_user']->id),
'submenu' => ''
);

$global_control_links['employees'] = array(
'linkinfo' => array($app_strings['LBL_EMPLOYEES']=> 'index.php?module=Employees&action=index&query=true'),
'submenu' => ''
);
if (
        is_admin($current_user)
		|| $current_user->isDeveloperForAnyModule()

        ) $global_control_links['admin'] = array(

'linkinfo' => array($app_strings['LBL_ADMIN'] => 'index.php?module=Administration&action=index'),
'submenu' => ''
);
/* no longer goes in the menubar - now implemented in the bottom bar.
$global_control_links['training'] = array(
'linkinfo' => array($app_strings['LBL_TRAINING'] => 'javascript:void(window.open(\'http://support.dotbcrm.com\'))'),
'submenu' => ''
 );
$global_control_links['help'] = array(
    'linkinfo' => array($app_strings['LNK_HELP'] => ' javascript:void window.open(\'index.php?module=Administration&action=SupportPortal&view=documentation&version='.$dotb_version.'&edition='.$dotb_flavor.'&lang='.$current_language.'&help_module='.$GLOBALS['module'].'&help_action='.$action.'&key='.$server_unique_key.'\')'),
    'submenu' => ''
 );
*/
$global_control_links['users'] = array(
'linkinfo' => array($app_strings['LBL_LOGOUT'] => 'index.php?module=Users&action=Logout'),
'submenu' => ''
);

$global_control_links['about'] = array('linkinfo' => array($app_strings['LNK_ABOUT'] => 'index.php?module=Home&action=About'),
'submenu' => ''
);

foreach(DotbAutoLoader::existing('custom/include/globalControlLinks.php', DotbAutoLoader::loadExtension("links")) as $file) {
    include $file;
}
