<?php

global $current_user;
global $dotb_config;

if(isset($_POST['timezone']) || isset($_GET['timezone'])) {
    if(isset($_POST['timezone'])) { 
    	$timezone = $_POST['timezone'];
    } else {
    	$timezone = $_GET['timezone'];
    }

	$current_user->setPreference('timezone', $timezone);
	$current_user->setPreference('ut', 1);
	$current_user->savePreferencesToDB();
	session_write_close();
	require_once('modules/Users/password_utils.php');
	if((($GLOBALS['dotb_config']['passwordsetting']['userexpiration'] > 0) &&
        	$_SESSION['hasExpiredPassword'] == '1'))
        header('Location: index.php?module=Users&action=ChangePassword');
    else
	   header('Location: index.php?action=index&module=Home');
   exit();
}
?>
