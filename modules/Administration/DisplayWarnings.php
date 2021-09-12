<?php


function displayAdminError($errorString){
	$output = '';  //COMMENT LICENSE - DD
	echo $output;  //COMMENT LICENSE - DD

}

function getLicenseUsers()
{
    global $db;
    $focus = Administration::getSettings();
    $license_users = isset($focus->settings['license_users'])?$focus->settings['license_users']:'';
    $activeUsers = $db->getOne("SELECT count(id) as total from users WHERE " . User::getLicensedUsersWhere());

    return ['license_users' => $license_users, 'active_users' => $activeUsers];
}

if(!empty($_SESSION['display_lotuslive_alert'])){
    displayAdminError(translate('MSG_RECONNECT_LOTUSLIVE', 'Administration'));
}

if (is_admin($current_user) && file_exists('include/DotbSearchEngine/DotbSearchEngineFactory.php')) {
    $ftsType = DotbSearchEngineFactory::getFTSEngineNameFromConfig();
    if(!empty($ftsType) && isset($GLOBALS['dotb_config']['full_text_engine'][$ftsType]['valid']) && !$GLOBALS['dotb_config']['full_text_engine'][$ftsType]['valid'])
    {
        displayAdminError(translate('LBL_FTS_CONNECTION_INVALID', 'Administration'));
    }

}

if (empty($license)){
	$license = Administration::getSettings('license');
}



// This section of code is a portion of the code referred
// to as Critical Control Software under the End User
// License Agreement.  Neither the Company nor the Users
// may modify any portion of the Critical Control Software.
//if (!isset($_SESSION['LICENSE_EXPIRES_IN'])) {
//    checkSystemLicenseStatus();
//}

//if (isset($_SESSION['LICENSE_EXPIRES_IN']) && $_SESSION['LICENSE_EXPIRES_IN'] != 'valid') {
//    if ($_SESSION['LICENSE_EXPIRES_IN'] < -1) {
//        setSystemState('LICENSE_KEY');
//    }
//}

//if (isset($_SESSION['VALIDATION_EXPIRES_IN']) && $_SESSION['VALIDATION_EXPIRES_IN'] != 'valid') {
//    if ($_SESSION['VALIDATION_EXPIRES_IN'] < -1) {
//        setSystemState('LICENSE_KEY');
//    }
//}
//END REQUIRED CODE DO NOT MODIFY


if(!empty($_SESSION['HomeOnly'])){
	displayAdminError(translate('FATAL_LICENSE_ALTERED', 'Administration'));
}

if(isset($license) && !empty($license->settings['license_msg_all'])){
	displayAdminError(base64_decode($license->settings['license_msg_all']));
}
if ( (strpos($_SERVER["SERVER_SOFTWARE"],'Microsoft-IIS') !== false) && (php_sapi_name() == 'cgi-fcgi') && (ini_get('fastcgi.logging') != '0') ) {
    displayAdminError(translate('LBL_FASTCGI_LOGGING', 'Administration'));
}
if(is_admin($current_user)){
if(!empty($_SESSION['COULD_NOT_CONNECT'])){
	displayAdminError(translate('LBL_COULD_NOT_CONNECT', 'Administration') . ' '. $timedate->to_display_date_time($_SESSION['COULD_NOT_CONNECT']));
}

if(isset($license) && !empty($license->settings['license_msg_admin'])){
    // UUDDLRLRBA
	$GLOBALS['log']->fatal(base64_decode($license->settings['license_msg_admin']));
	return;
}

//No SMTP server is set up Error.
$smtp_error = false;
$admin = Administration::getSettings();

//If sendmail has been configured by setting the config variable ignore this warning
$sendMailEnabled = isset($dotb_config['allow_sendmail_outbound']) && $dotb_config['allow_sendmail_outbound'];

if(trim($admin->settings['mail_smtpserver']) == '' && !$sendMailEnabled) {
    if($admin->settings['notify_on']) {
        $smtp_error = true;
    }
    else {
        $workflow = BeanFactory::newBean('WorkFlow');
        if($workflow->getActiveWorkFlowCount()>0) {
            $smtp_error = true;
        }
    }
}

if($smtp_error) {
    displayAdminError(translate('WARN_NO_SMTP_SERVER_AVAILABLE_ERROR','Administration'));
}

 if(!empty($dbconfig['db_host_name']) || $dotb_config['dotb_version'] != $dotb_version ){
       		displayAdminError(translate('WARN_REPAIR_CONFIG', 'Administration'));
        }

        if( !isset($dotb_config['installer_locked']) || $dotb_config['installer_locked'] == false ){
        	displayAdminError(translate('WARN_INSTALLER_LOCKED', 'Administration'));
		}


// This section of code is a portion of the code referred
// to as Critical Control Software under the End User
// License Agreement.  Neither the Company nor the Users
// may modify any portion of the Critical Control Software.

//    if (isset($_SESSION['LICENSE_EXPIRES_IN']) && strcmp($_SESSION['LICENSE_EXPIRES_IN'], 'valid') != 0) {
//        	 if(strcmp($_SESSION['LICENSE_EXPIRES_IN'], 'REQUIRED') == 0){
//        	 		setSystemState('LICENSE_KEY');
//	         			displayAdminError( translate('FATAL_LICENSE_REQUIRED', 'Administration') );
//        	 }
//	         else if( $_SESSION['LICENSE_EXPIRES_IN'] < 0  ){
//	         	if($_SESSION['LICENSE_EXPIRES_IN'] < -30){
//	         			setSystemState('LICENSE_KEY');
//	         			displayAdminError( translate('FATAL_LICENSE_EXPIRED', 'Administration'). " [". abs($_SESSION['LICENSE_EXPIRES_IN']) . " " . translate('LBL_DAYS', 'Administration') . " ] .<br> ". translate('FATAL_LICENSE_EXPIRED2', 'Administration') );
//	         	}else{
//	         		displayAdminError( translate('ERROR_LICENSE_EXPIRED', 'Administration'). abs($_SESSION['LICENSE_EXPIRES_IN']) . translate('ERROR_LICENSE_EXPIRED2', 'Administration') );
//	         	}
//
//	        }
//	        else if( $_SESSION['LICENSE_EXPIRES_IN'] >= 0 ){
//
//	           displayAdminError( translate('WARN_LICENSE_EXPIRED', 'Administration'). $_SESSION['LICENSE_EXPIRES_IN'] . translate('WARN_LICENSE_EXPIRED2', 'Administration') );
//	        }
//    } elseif (strcmp($_SESSION['VALIDATION_EXPIRES_IN'], 'valid') != 0) {
//         	 if(strcmp($_SESSION['VALIDATION_EXPIRES_IN'], 'REQUIRED') == 0){
//        	 		setSystemState('LICENSE_KEY');
//	         		displayAdminError( translate('FATAL_VALIDATION_REQUIRED', 'Administration'));
//        	 }
//	         else if( $_SESSION['VALIDATION_EXPIRES_IN'] < 0  ){
//	         		if($_SESSION['VALIDATION_EXPIRES_IN'] < -30){
//	         			setSystemState('LICENSE_KEY');
//	         			displayAdminError( translate('FATAL_VALIDATION_EXPIRED', 'Administration') . " [". abs($_SESSION['VALIDATION_EXPIRES_IN']) . " day(s) ] .<br>   " . translate('FATAL_VALIDATION_EXPIRED2', 'Administration') );
//	         	}else{
//	         		displayAdminError( translate('ERROR_VALIDATION_EXPIRED', 'Administration') . abs($_SESSION['VALIDATION_EXPIRES_IN']) .  translate('ERROR_VALIDATION_EXPIRED2', 'Administration') );
//	         	}
//	         }
//	        else if( $_SESSION['VALIDATION_EXPIRES_IN'] >= 0 ){
//	           displayAdminError(  translate('WARN_VALIDATION_EXPIRED', 'Administration'). $_SESSION['VALIDATION_EXPIRES_IN'] .translate('WARN_VALIDATION_EXPIRED2', 'Administration')  );
//	        }
//    }

//    if (!isset($_SESSION['license_seats_needed'])) {
//        $licenseInfo = getLicenseUsers();
//        $_SESSION['license_seats_needed'] =  $licenseInfo['active_users'] - $licenseInfo['license_users'];
//    }

//    if ($_SESSION['license_seats_needed'] > 0) {
//        $licenseInfo = $licenseInfo ?? getLicenseUsers();
//        displayAdminError(translate('WARN_LICENSE_SEATS', 'Administration')
//            . $licenseInfo['active_users'] . translate('WARN_LICENSE_SEATS2', 'Administration')
//            .  $licenseInfo['license_users'] . translate('WARN_LICENSE_SEATS3', 'Administration'));
//    }
        //END REQUIRED CODE DO NOT MODIFY
        if(empty($GLOBALS['dotb_config']['admin_access_control'])){
			if (isset($_SESSION['available_version'])){
				if($_SESSION['available_version'] != $dotb_version)
				{
					displayAdminError(translate('WARN_UPGRADENOTE', 'Administration').$_SESSION['available_version_description']);
				}
			}
        }

		if(isset($_SESSION['administrator_error']))
		{
			// Only print DB errors once otherwise they will still look broken
			// after they are fixed.
			displayAdminError($_SESSION['administrator_error']);
		}

		unset($_SESSION['administrator_error']);
}
