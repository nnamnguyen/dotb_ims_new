<?php


/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

if (!is_admin($current_user)) {
    dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
}
global $dotb_config;

$enable_snip = '';
$disable_snip = '';

$snip = DotbSNIP::getInstance();
$title = getClassicModuleTitle('Administration', array(
	"<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>",
	translate('LBL_CONFIGURE_SNIP')), false);
$dotb_smarty = new Dotb_Smarty();

$dotb_smarty->assign('APP', $GLOBALS['app_strings']);
$dotb_smarty->assign('MOD', $GLOBALS['mod_strings']);

$extra_error='';

if ($_POST && isset($_POST['snipaction'])) {
	if ($_POST['snipaction']=='enable_snip') {
		$enable_snip = $snip->registerSnip();
		if (!$enable_snip || $enable_snip->result!='ok') {
		    if(!empty($enable_snip->message)) {
		        $message = $enable_snip->message;
		    } else {
		        $message = $snip->getLastError();
		    }
		    if(empty($message)) {
	    		$extra_error = '<b>'.$GLOBALS['mod_strings']['LBL_SNIP_ERROR_ENABLING'].'</b>. '.$GLOBALS['mod_strings']['LBL_CONTACT_SUPPORT'];
		    } else {
			    $extra_error = '<b>'.$GLOBALS['mod_strings']['LBL_SNIP_ERROR_ENABLING'].'</b>: '.$message.'. <br>'.$GLOBALS['mod_strings']['LBL_CONTACT_SUPPORT'];
		    }
		}
	} else if ($_POST['snipaction']=='disable_snip') {
		$disable_snip = $snip->unregisterSnip();
		if (!$disable_snip || $disable_snip->result!='ok') {
		    if(!empty($disable_snip->message)) {
		        $message = $disable_snip->message;
		    } else {
		        $message = $snip->getLastError();
		    }
		    if(empty($message)) {
    			$extra_error = '<b>'.$GLOBALS['mod_strings']['LBL_SNIP_ERROR_DISABLING'].'</b>. '.$GLOBALS['mod_strings']['LBL_CONTACT_SUPPORT'];
	    	} else {
			    $extra_error = '<b>'.$GLOBALS['mod_strings']['LBL_SNIP_ERROR_DISABLING'].'</b>: '.$message.'. <br>'.$GLOBALS['mod_strings']['LBL_CONTACT_SUPPORT'];
		    }
		}
	}
}

$status=$snip->getStatus();

$message=$status['message'];
$status=$status['status'];

if ($status=='pingfailed'){
	$status='notpurchased';
	$extra_error=$GLOBALS['mod_strings']['LBL_SNIP_STATUS_PINGBACK_FAIL_SUMMARY'];
}

if ($message=='' && $status != 'notpurchased') {
	if (isset ($GLOBALS['mod_strings']['LBL_SNIP_GENERIC_ERROR']))
		$message = $GLOBALS['mod_strings']['LBL_SNIP_GENERIC_ERROR'];
}

if ($status=='purchased_error')
	$dotb_smarty->assign('SNIP_ERROR_MESSAGE',$message);

require_once("install/install_utils.php");

$dotb_smarty->assign('TITLE',$title);
$dotb_smarty->assign('SNIP_STATUS',$status);
$dotb_smarty->assign('EXTRA_ERROR',$extra_error);
$dotb_smarty->assign('SNIP_EMAIL',$snip->getSnipEmail());
$dotb_smarty->assign('SNIP_URL',$snip->getSnipURL());
$dotb_smarty->assign('DOTB_URL',$snip->getURL());
$dotb_smarty->assign('LICENSE',nl2br(trim(getLicenseContents("LICENSE"))));

echo $dotb_smarty->fetch('modules/SNIP/ConfigureSnip.tpl');
