<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright(C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
if (!defined('DOTB_PHPUNIT_RUNNER')) {
    session_regenerate_id(false);
}
global $mod_strings;
$res = $GLOBALS['dotb_config']['passwordsetting'];
$login_vars = $GLOBALS['app']->getLoginVars(false);

$user_name = isset($_REQUEST['user_name'])
    ? $_REQUEST['user_name'] : '';

$password = isset($_REQUEST['user_password'])
    ? $_REQUEST['user_password'] : '';

$authController->login($user_name, $password);
// authController will set the authenticated_user_id session variable
if(isset($_SESSION['authenticated_user_id'])) {
	// Login is successful
	if ( $_SESSION['hasExpiredPassword'] == '1' && $_REQUEST['action'] != 'Save') {
		$GLOBALS['module'] = 'Users';
        $GLOBALS['action'] = 'ChangePassword';
        ob_clean();
        header("Location: index.php?module=Users&action=ChangePassword");
        dotb_cleanup(true);
    }
    global $record;
    global $current_user;
    global $dotb_config;

    if ( isset($_SESSION['isMobile'])
            && ( empty($_REQUEST['login_module']) || $_REQUEST['login_module'] == 'Users' )
            && ( empty($_REQUEST['login_action']) || $_REQUEST['login_action'] == 'wirelessmain' ) ) {
        $last_module = $current_user->getPreference('wireless_last_module');
        if ( !empty($last_module) ) {
            $login_vars['login_module'] = $_REQUEST['login_module'] = $last_module;
            $login_vars['login_action'] = $_REQUEST['login_action'] = 'wirelessmodule';
        }
    }
    global $current_user;

    if(isset($current_user)  && empty($login_vars)) {
        if(!empty($GLOBALS['dotb_config']['default_module']) && !empty($GLOBALS['dotb_config']['default_action'])) {
            $url = "index.php?module={$GLOBALS['dotb_config']['default_module']}&action={$GLOBALS['dotb_config']['default_action']}";
        } else {
    	    $modListHeader = query_module_access_list($current_user);
    	    //try to get the user's tabs
    	    $tempList = $modListHeader;
    	    $idx = array_shift($tempList);
    	    if(!empty($modListHeader[$idx])){
    	    	$url = "index.php?module={$modListHeader[$idx]}&action=index";
    	    }
        }
    } else {
        $url = $GLOBALS['app']->getLoginRedirect();
    }
} else {
	// Login has failed
	$url ="index.php?module=Users&action=Login";
    if(!empty($login_vars))
    {
        $url .= '&' . http_build_query($login_vars);
    }
}

// construct redirect url
$url = 'Location: '.$url;

//adding this for bug: 21712.
if(!empty($GLOBALS['app'])) {
    $GLOBALS['app']->headerDisplayed = true;
}
if (!defined('DOTB_PHPUNIT_RUNNER')) {
    dotb_cleanup();
}
