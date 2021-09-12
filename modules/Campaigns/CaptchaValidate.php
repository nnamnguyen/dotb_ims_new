<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

 /**Check captcha validation here.
 *
 */
require_once('vendor/reCaptcha/recaptchalib.php');

$admin = Administration::getSettings('captcha');
if($admin->settings['captcha_on']=='1' && !empty($admin->settings['captcha_private_key'])){
	$privatekey = $admin->settings['captcha_private_key'];
}else
	die("Captcha settings not found");
$response = recaptcha_check_answer($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_REQUEST["recaptcha_challenge_field"],
									$_REQUEST["recaptcha_response_field"]);
if(!$response->is_valid){
	die("Invalid captcha entry, go back and fix. ". $response->error. " ");
}
else echo("Success");

?>
