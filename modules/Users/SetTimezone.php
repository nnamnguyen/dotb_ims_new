<?php




require_once('modules/Users/Forms.php');

global $app_strings;
global $app_list_strings;
global $mod_strings;

$admin = Administration::getSettings("notify");

if ( isset($_SESSION['isMobile']) ) {
	session_destroy();
	session_start();
    $_SESSION['login_error'] = $mod_strings['ERR_NO_LOGIN_MOBILE'];
    header("Location: index.php?module=Users&action=Login&mobile=1");
    dotb_cleanup(true);
}

///////////////////////////////////////////////////////////////////////////////
////	HELPER FUNCTIONS
////	END HELPER FUNCTIONS
///////////////////////////////////////////////////////////////////////////////

if(isset($_REQUEST['userOffset'])) { // ajax call to lookup timezone
    echo 'userTimezone = "' . TimeDate::guessTimezone($_REQUEST['userOffset']) . '";';
    exit();
}
$admin = Administration::getSettings();
$dotb_smarty = new Dotb_Smarty();
$dotb_smarty->assign('MOD', $mod_strings);
$dotb_smarty->assign('APP', $app_strings);

global $current_user;
$selectedZone = $current_user->getPreference('timezone');
if(empty($selectedZone) && !empty($_REQUEST['gmto'])) {
	$selectedZone = TimeDate::guessTimezone(-1 * $_REQUEST['gmto']);
}
if(empty($selectedZone)) {
    $selectedZone = TimeDate::guessTimezone();
}
$dotb_smarty->assign('TIMEZONE_CURRENT', $selectedZone);
$dotb_smarty->assign('TIMEZONEOPTIONS', TimeDate::getTimezoneList());

$dotb_smarty->display('modules/Users/SetTimezone.tpl');