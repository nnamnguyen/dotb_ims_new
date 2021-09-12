<?php

/*********************************************************************************
********************************************************************************/

/**
 * Proxy to DotbSystemInfo::getInstance()->getInfo()
 * Exists for BWC
 *
 * @param bool $send_usage_info
 * @return array
 */
function getSystemInfo($send_usage_info = true)
{
    return DotbSystemInfo::getInstance()->getInfo();
}

/**
 * Proxy to DotbSystemInfo::getInstance()->getInfo()
 * Exists for BWC
 *
 * @param bool $send_usage_info
 * @return array
 */
function getBaseSystemInfo($send_usage_info = true)
{
    return DotbSystemInfo::getInstance()->getBaseInfo();
}

function check_now($send_usage_info=true, $get_request_data=false, $response_data = false, $from_install=false ) {
	global $dotb_config, $timedate;
	global $db, $license;

	$return_array=array();
    if(!$from_install && empty($license))loadLicense(true);

	if(!$response_data){

        $systemInfo = DotbSystemInfo::getInstance();
        DotbAutoLoader::requireWithCustom('include/DotbHeartbeat/DotbHeartbeatClient.php', true);
        $sclientClass = DotbAutoLoader::customClass('DotbHeartbeatClient');
        $sclient = new $sclientClass();

        if($from_install){
    		$info = $systemInfo->getBaseInfo();

        }else{
            $info = $systemInfo->getInfo();
        }


		// This section of code is a portion of the code referred
		// to as Critical Control Software under the End User
		// License Agreement.  Neither the Company nor the Users
		// may modify any portion of the Critical Control Software.
		if(!empty( $license->settings['license_key'])){
			$key = $license->settings['license_key'];
		}else{
			//END REQUIRED CODE


			$key = '4829482749329';


		}



		$encoded = dotbEncode($key, serialize($info));

		if($get_request_data){
			$request_data = array('key'=>$key, 'data'=>$encoded);
			return serialize($request_data);
		}
	//	$encodedResult = $sclient->dotbHome($key, $info);

	}else{
	//	$encodedResult = 	$response_data['data'];
		$key = $response_data['key'];

	}

    if ($response_data || !$sclient->getError()) {
		$serializedResultData = dotbDecode($key,$encodedResult);
		$resultData = unserialize($serializedResultData);
        if($response_data && empty($resultData))
		{
			$resultData = array();
			$resultData['validation'] = 'invalid validation key';
		}
	}else
	{
		$resultData = array();
		$resultData['versions'] = array();

	}
    if (!isset($resultData['validation'])) {
        $resultData['validation'] = 'invalid';
    }
	if($response_data || !$sclient->getError() )
	{

		// This section of code is a portion of the code referred
		// to as Critical Control Software under the End User
		// License Agreement.  Neither the Company nor the Users
		// may modify any portion of the Critical Control Software.
		checkDownloadKey($resultData['validation']);
		//END REQUIRED CODE
		if(!empty($resultData['msg'])){
			if(!empty($resultData['msg']['admin'])){
				$license->saveSetting('license', 'msg_admin', base64_encode($resultData['msg']['admin']));
			}else{
				$license->saveSetting('license', 'msg_admin','');
			}
			if(!empty($resultData['msg']['all'])){
				$license->saveSetting('license', 'msg_all', base64_encode($resultData['msg']['all']));
			}else{
				$license->saveSetting('license', 'msg_all','');
			}
		}else{
			$license->saveSetting('license', 'msg_admin','');
			$license->saveSetting('license', 'msg_all','');
		}
		$license->saveSetting('license', 'last_validation', 'success');
		unset($_SESSION['COULD_NOT_CONNECT']);
	}
	else
	{
		$resultData = array();
		$resultData['versions'] = array();

		$license->saveSetting('license', 'last_connection_fail', TimeDate::getInstance()->nowDb());
		$license->saveSetting('license', 'last_validation', 'no_connection');

		if( empty($license->settings['license_last_validation_success']) && empty($license->settings['license_last_validation_fail']) && empty($license->settings['license_vk_end_date'])){
			$license->saveSetting('license', 'vk_end_date', TimeDate::getInstance()->nowDb());

			$license->saveSetting('license', 'validation_key', base64_encode(serialize(array('verified'=>false))));
		}
		$_SESSION['COULD_NOT_CONNECT'] =TimeDate::getInstance()->nowDb();

	}
	if(!empty($resultData['versions'])){

		$license->saveSetting('license', 'latest_versions',base64_encode(serialize($resultData['versions'])));
	}else{
		$resultData['versions'] = array();
		$license->saveSetting('license', 'latest_versions','')	;
	}




	include('dotb_version.php');

	if(sizeof($resultData) == 1 && !empty($resultData['versions'][0]['version'])
        && compareVersions($dotb_version, $resultData['versions'][0]['version']))
	{
		$resultData['versions'][0]['version'] = $dotb_version;
		$resultData['versions'][0]['description'] = "You have the latest version.";
	}


	return $resultData['versions'];
}
/*
 * returns true if $ver1 > $ver2
 */
function compareVersions($ver1, $ver2)
{
    return (version_compare($ver1, $ver2) === 1);
}
function set_CheckUpdates_config_setting($value) {


	$admin = BeanFactory::newBean('Administration');
	$admin->saveSetting('Update','CheckUpdates',$value);
}
/* return's value for the 'CheckUpdates' config setting
* if the setting does not exist one gets created with a default value of automatic.
*/
function get_CheckUpdates_config_setting() {

	$checkupdates='automatic';


	$admin = Administration::getSettings('Update',true);
	if (empty($admin->settings) or empty($admin->settings['Update_CheckUpdates'])) {
		$admin->saveSetting('Update','CheckUpdates','automatic');
	} else {
		$checkupdates=$admin->settings['Update_CheckUpdates'];
	}
	return $checkupdates;
}

function set_last_check_version_config_setting($value) {


	$admin = BeanFactory::newBean('Administration');
	$admin->saveSetting('Update','last_check_version',$value);
}
function get_last_check_version_config_setting() {



	$admin = Administration::getSettings('Update');
	if (empty($admin->settings) or empty($admin->settings['Update_last_check_version'])) {
		return null;
	} else {
		return $admin->settings['Update_last_check_version'];
	}
}


function set_last_check_date_config_setting($value) {


	$admin = BeanFactory::newBean('Administration');
	$admin->saveSetting('Update','last_check_date',$value);
}
function get_last_check_date_config_setting() {



	$admin = Administration::getSettings('Update');
	if (empty($admin->settings) or empty($admin->settings['Update_last_check_date'])) {
		return 0;
	} else {
		return $admin->settings['Update_last_check_date'];
	}
}

function set_dotbbeat($value) {
	global $dotb_config;
	$_DOTBBEAT="dotbbeet";
	$dotb_config[$_DOTBBEAT] = $value;
	write_array_to_file( "dotb_config", $dotb_config, "config.php" );
}
function get_dotbbeat() {


	/*

	global $dotb_config;
	$_DOTBBEAT="dotbbeet";

	if (isset($dotb_config[$_DOTBBEAT]) && $dotb_config[$_DOTBBEAT] == false) {
	return false;
	}
	*/

	return true;

}



function shouldCheckDotb(){
	global $license, $timedate;
	if(

	(empty($license->settings['license_last_validation_fail']) ||  $license->settings['license_last_validation_fail'] < $timedate->getNow()->modify("-6 hours")->asDb(false))  &&
    (get_CheckUpdates_config_setting() == 'automatic' || !empty($GLOBALS['dotb_config']['hide_admin_licensing']))) {
		return true;
	}

	return false;
}

// This section of code is a portion of the code referred
// to as Critical Control Software under the End User
// License Agreement.  Neither the Company nor the Users
// may modify any portion of the Critical Control Software.


/**
 * Authenticate license settings
 * @return boolean
 */
function authenticateDownloadKey()
{
    return true;
}

function checkDownloadKey($data){
	return 'Validation Complete';
}



/**
 * Whitelist of modules and actions that don't need redirect
 *
 * Use following standard for whitelist:
 * array(
 *		'module_name_1' => array('action_name_1', 'action_name_2', ...),	// Allow only "action_name_1" and "action_name_2" for "module_name_1"
 *		'module_name_2' => 'all',	|										// Allow ALL actions in module "module_name_2"
 *		...
 *		)
 * @param User $user
 * @return array
 */
function getModuleWhiteListForLicenseCheck(User $user) {
	$admin_white_list = array(
		'Administration'		=> array('LicenseSettings', 'Save'),
		'Configurator'			=> 'all',
		'Home'					=> array('About'),
		'Notifications'			=> array('quicklist'),
		'Users'					=> array('SetTimezone', 'SaveTimezone', 'Logout')
	);

	$not_admin_white_list	= array(
		'Users'					=> array('Logout', 'Login')
	);

	$white_list				= is_admin($user)?$admin_white_list:$not_admin_white_list;

	return $white_list;
}

/**
 * Check if $module and $action don't get into whitelist and do we need redirect
 *
 * @param string	$state	Now works only for 'LICENSE_KEY' state (TODO: do we need any other state?)
 * @param string	$module	Module to check
 * @param string	$action	(optional) Action to check. Can be omitted because some modules include all actions
 * @return boolean
 */
function isNeedRedirectDependingOnUserAndSystemState($state, $module = null, $action = null, $whiteList = array()) {
	if($module !== null) {
		if($state == 'LICENSE_KEY') {
			foreach($whiteList as $wlModule => $wlActions) {
				if($module == $wlModule && ($wlActions === 'all' || in_array($action, $wlActions))) {
					return false;
				}
			}
		}
	}

	return true;
}

/**
 * Redirect current user if current module and action isn't in whitelist
 * @global User		$current_user	User object that stores current application user
 * @param string	$state			Now works only for 'LICENSE_KEY' state  (TODO: do we need any other state?)
 */
function setSystemState($state){
//	global $current_user;
//	$admin_redirect_url		= 'index.php?action=LicenseSettings&module=Administration&LicState=check';
//	$not_admin_redirect_url	= 'index.php?module=Users&action=Logout&LicState=check';
//
//	if(isset($current_user) && !empty($current_user->id)){
//		if(isNeedRedirectDependingOnUserAndSystemState($state, $_REQUEST['module'], $_REQUEST['action'], getModuleWhiteListForLicenseCheck($current_user))) {
//			$redirect_url			= is_admin($current_user)?$admin_redirect_url:$not_admin_redirect_url;
//			header('Location: '.$redirect_url);
//			dotb_cleanup(true);
//		}
//	}
}

/**
 * Used by SOAP services
 */
function checkSystemState()
{
    if ($_SESSION['LICENSE_EXPIRES_IN'] === 'REQUIRED') {
        die('LICENSE INFORMATION IS REQUIRED PLEASE CONTACT A SYSTEM ADMIN ');
    }
    if ($_SESSION['VALIDATION_EXPIRES_IN'] === 'REQUIRED') {
        die('LICENSE INFORMATION IS REQUIRED PLEASE CONTACT A SYSTEM ADMIN ');
    }
    if ($_SESSION['LICENSE_EXPIRES_IN'] != 'valid' && $_SESSION['LICENSE_EXPIRES_IN'] < -30) {
        die('LICENSE EXPIRED ' . abs($_SESSION['LICENSE_EXPIRES_IN']) .' day(s) ago - PLEASE CONTACT A SYSTEM ADMIN');
    }
    if ($_SESSION['VALIDATION_EXPIRES_IN'] != 'valid' && $_SESSION['VALIDATION_EXPIRES_IN'] < -30) {
        die('VALIDATION KEY FOR LICENSE EXPIRED ' . abs($_SESSION['VALIDATION_EXPIRES_IN']) .' day(s) ago - PLEASE CONTACT A SYSTEM ADMIN');
    }
}

/**
 * Check current license status
 */
function checkSystemLicenseStatus()
{
    global $license;
    loadLicense(true);

    if (!empty($license->settings)) {

        if (isset($license->settings['license_vk_end_date'])) {
            $_SESSION['VALIDATION_EXPIRES_IN'] = isAboutToExpire($license->settings['license_vk_end_date']);
        } else {
            $_SESSION['VALIDATION_EXPIRES_IN'] = 'REQUIRED';
        }

        if (!empty($license->settings['license_expire_date'])) {
            $_SESSION['LICENSE_EXPIRES_IN'] = isAboutToExpire($license->settings['license_expire_date']);
        } else {
            $_SESSION['LICENSE_EXPIRES_IN'] = 'REQUIRED';
        }
    } else {
        $_SESSION['INVALID_LICENSE'] = true;
    }
}

/**
 * Check if system status is OK
 * @param string $forceReload
 * @return array|true True on OK or array with system status problem
 */
function apiCheckSystemStatus($forceReload = false)
{
    global $dotb_config, $dotb_flavor, $db;

    if (!isset($dotb_config['installer_locked']) || $dotb_config['installer_locked'] == false ){
        return array(
            'level'  =>'admin_only',
            'message'=>'WARN_INSTALLER_LOCKED',
            'url'    =>'install.php',
        );
    }

    // If they are missing session variables force a reload
    $sessionCheckNotExists = array(
        'VALIDATION_EXPIRES_IN',
        'LICENSE_EXPIRES_IN',
    );
    $sessionCheckExists = array(
        'HomeOnly',
        'INVALID_LICENSE',
    );
    foreach ($sessionCheckNotExists as $key) {
        if (!isset($_SESSION[$key])) {
            $forceReload = true;
        }
    }
    foreach ($sessionCheckExists as $key) {
        if (!empty($_SESSION[$key])) {
            $forceReload = true;
        }
    }

    $systemStatus = apiLoadSystemStatus($forceReload);

    // Don't allow maintenanceMode to override license failures
    if ($systemStatus === true
        && !empty($GLOBALS['dotb_config']['maintenanceMode'])) {
        $url = 'maintenance.php';
        if ($GLOBALS['dotb_config']['maintenanceMode'] !== true) {
            $url = $GLOBALS['dotb_config']['maintenanceMode'];
        }

        return array(
            'level'  =>'maintenance',
            'message'=>'EXCEPTION_MAINTENANCE',
            'url'    =>$url,
        );

    }

    return $systemStatus;
}

/**
 * Get system status from cache or settings or calculate it
 * @param string $forceReload
 * @return array|boolean
 */
function apiLoadSystemStatus($forceReload = false)
{
    $systemStatus = null;
    $oldSystemStatus = null;
    // First try from DotbCache
    $systemStatus = dotb_cache_retrieve('api_system_status');
    if (empty($systemStatus)) {
        // No luck, try the database
	    $administration = Administration::getSettings('system');
        // key defined in Adminitration::retrieveSettings(): $key = $row['category'] . '_' . $row['name'];
        if (!empty($administration->settings['system_api_system_status'])) {
            $systemStatus = unserialize(base64_decode($administration->settings['system_api_system_status']));
        }
    } else {
        // if it's not an array and is truthy, comvert it to true
        // See BR-1150
        if($systemStatus && !is_array($systemStatus)) {
            $systemStatus = true;
        }
    }

    if (!empty($systemStatus)) {
        // Save the old system status, so if the new one is the same
        // even on a force reload, we don't update it.
        $oldSystemStatus = $systemStatus;
    }
    if ($forceReload) {
        $systemStatus = null;
    }

    if (empty($systemStatus)) {
        $systemStatus = apiActualLoadSystemStatus();
    }
    $serializedStatus = serialize($systemStatus);
    if ($serializedStatus != serialize($oldSystemStatus)) {
        dotb_cache_put('api_system_status',$systemStatus);
        if (!isset($administration)) {
            $administration = Administration::getSettings('system');
        }
        $administration->saveSetting('system','api_system_status',base64_encode($serializedStatus));
    }

    return $systemStatus;
}

/**
 *  Get actual system status
 *  No caching, just check the system status
 */
function apiActualLoadSystemStatus()
{
    global $dotb_flavor, $db;

    checkSystemLicenseStatus();
    $admin = Administration::getSettings();

    if (!empty($admin->settings['license_enforce_user_limit'])) {
        // BEGIN License User Limit Enforcement
        $query = "SELECT count(id) as total from users WHERE ".User::getLicensedUsersWhere();
        $result = $db->query($query, true, "Error filling in user array: ");
        $row = $db->fetchByAssoc($result);

        $license_users = $admin->settings['license_users'];
        $license_seats_needed = $row['total'] - $license_users;
        if ($license_seats_needed > 0) {
            $_SESSION['license_seats_needed'] = $license_seats_needed;
            $_SESSION['EXCEEDS_MAX_USERS'] = 1;
            return array(
                    'level'  =>'admin_only',
                    'message'=>'ERROR_LICENSE_SEATS_MAXED',
                    'url'    =>'#bwc/index.php?module=Users&action=index',
            );
        }
        // END License User Limit Enforcement
    }

    // Only allow administrators because of altered license issue
    if (!empty($_SESSION['HomeOnly'])) {
        return array(
            'level'  =>'admin_only',
            'message'=>'FATAL_LICENSE_ALTERED',
            'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
        );
    }

        if (!empty($_SESSION['INVALID_LICENSE'])) {
            return array(
                'level'  =>'admin_only',
                'message'=>'ERROR_LICENSE_VALIDATION',
                'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
            );
        }
        if (isset($_SESSION['LICENSE_EXPIRES_IN'])
            && $_SESSION['LICENSE_EXPIRES_IN'] != 'valid') {
            if ($_SESSION['LICENSE_EXPIRES_IN'] < -1) {
                return array(
                    'level'  =>'admin_only',
                    'message'=>'ERROR_LICENSE_EXPIRED',
                    'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
                    );
            } else if (isset($GLOBALS['current_user']->id)
                       && $GLOBALS['current_user']->isAdmin()) {
                // Not yet expired, but soon enough to warn
                return array(
                    'level'  =>'warning',
                    'message'=>'WARN_LICENSE_EXPIRED',
                    'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
                    );
            }
        } elseif (isset($_SESSION['VALIDATION_EXPIRES_IN'])
                  && $_SESSION['VALIDATION_EXPIRES_IN'] != 'valid') {
            if ($_SESSION['VALIDATION_EXPIRES_IN'] < -1 ) {
                return array(
                    'level'  =>'admin_only',
                    'message'=>'ERROR_LICENSE_VALIDATION',
                    'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
                );
            } else if (isset($GLOBALS['current_user']->id)
                       && $GLOBALS['current_user']->isAdmin()) {
                // Not yet expired, but soon enough to warn
                return array(
                    'level'  =>'warning',
                    'message'=>'WARN_LICENSE_VALIDATION',
                    'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
                );
            }
        }

    return true;
}

function apiCheckLoginStatus()
{
    unset($GLOBALS['login_error']);

    // Run loginLicense()
    loginLicense();

    // The other license check codes are handled by apiCheckSystemLicenseStatus
    if (!empty($GLOBALS['login_error'])) {
        return array(
            'level'  =>'admin_only',
            'message'=>'ERROR_LICENSE_VALIDATION',
            'url'    =>'#bwc/index.php?action=LicenseSettings&module=Administration',
        );
    }

    // Force it to recheck the system license on login
    unset($_SESSION['LICENSE_EXPIRES_IN']);
    return apiCheckSystemStatus();
}




function isAboutToExpire($expire_date, $days_before_warning = 7){
	$seconds_before_warning = $days_before_warning * 24 * 60 * 60;
	$seconds_to_expire = 0;
	if(!empty($expire_date))
	{
		$seconds_to_expire = strtotime( $expire_date ) - time();
	}

	if( $seconds_to_expire < $seconds_before_warning ){
		$days_to_expire =  intval($seconds_to_expire / (60 * 60 * 24 ));
		return $days_to_expire;
	}
	else {
		return 'valid';
	}
}
//END REQUIRED CODE


function loadLicense($firstLogin=false){

	$GLOBALS['license'] = Administration::getSettings('license', $firstLogin);

}

function loginLicense(){
	global $current_user, $license;
	loadLicense(true);

	if((isset($_SESSION['EXCEEDS_MAX_USERS']) && $_SESSION['EXCEEDS_MAX_USERS'] == 1 ) || empty($license->settings['license_key']) || (!empty($license->settings['license_last_validation']) && $license->settings['license_last_validation'] == 'failed' &&  !empty($license->settings['license_last_validation_fail']) && (empty($license->settings['license_last_validation_success']) || $license->settings['license_last_validation_fail'] > $license->settings['license_last_validation_success']))){

		if(!is_admin($current_user)){
		   $GLOBALS['login_error'] = $GLOBALS['app_strings']['ERROR_LICENSE_VALIDATION'];
		   $_SESSION['login_error'] =  $GLOBALS['login_error'];
		}else{
			if(empty($license->settings['license_key'])){
				$_SESSION['VALIDATION_EXPIRES_IN'] = 'REQUIRED';
			}else{
				$_SESSION['COULD_NOT_CONNECT'] = $license->settings['license_last_validation_fail'];
			}
		}

	}


	if (shouldCheckDotb()) {


		$last_check_date=get_last_check_date_config_setting();
		$current_date_time=time();
		$time_period=3*23*3600 ;
		if (($current_date_time - $last_check_date) > $time_period
		|| empty($license->settings['license_last_validation_success'])
		) {
			$version = check_now(get_dotbbeat());

			unset($_SESSION['license_seats_needed']);

			unset($_SESSION['LICENSE_EXPIRES_IN']);
			unset($_SESSION['VALIDATION_EXPIRES_IN']);
			unset($_SESSION['HomeOnly']);
			loadLicense();
			set_last_check_date_config_setting("$current_date_time");
			include('dotb_version.php');

            $newVersion = '';
            if (!empty($version) && count($version) == 1)
            {
                $newVersion = $version[0]['version'];
            }

            if (version_compare($newVersion, $dotb_version, '>') && is_admin($current_user))
			{
				//set session variables.
				$_SESSION['available_version']=$version[0]['version'];
				$_SESSION['available_version_description']=$version[0]['description'];
				set_last_check_version_config_setting($version[0]['version']);
			}
		}
	}

	// This section of code is a portion of the code referred
	// to as Critical Control Software under the End User
	// License Agreement.  Neither the Company nor the Users
	// may modify any portion of the Critical Control Software.

    //if (!authenticateDownloadKey()) {
	//   if(is_admin($current_user)){
	//	  $_SESSION['HomeOnly'] = true;
	//    }else{
	//         $_SESSION['login_error'] = $GLOBALS['app_strings']['ERROR_LICENSE_VALIDATION'];
     //   $GLOBALS['login_error'] =  $GLOBALS['app_strings']['ERROR_LICENSE_VALIDATION'];
	//    }
	//}
	//END REQUIRED CODE DO NOT MODIFY

}
