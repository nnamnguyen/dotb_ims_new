<?php

/*********************************************************************************

 * Description: TODO:  To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

if (isset($_POST['saveConfig'])){
	$focus = BeanFactory::getBean('Users', $_POST['record']);	
	if(!$focus->change_password($_POST['old_password'], $_POST['new_password']))
		DotbApplication::redirect("index.php?action=ChangePassword&module=Users&record=".$_POST['record']."&error_password=".urlencode($focus->error_string));
    
	// Send to new user wizard if it hasn't been run
	$ut = $GLOBALS['current_user']->getPreference('ut');
    if(empty($ut))
        DotbApplication::redirect('index.php?module=Users&action=Wizard');
    
    // Otherwise, send to home page
    DotbApplication::redirect('index.php?module=Home&action=index');
}

require_once('modules/Administration/Forms.php');
$configurator = new Configurator();
$dotbConfig = DotbConfig::getInstance();


$dotb_smarty = new Dotb_Smarty();
$dotb_smarty->assign('MOD', $mod_strings);
$dotb_smarty->assign('APP', $app_strings);
$dotb_smarty->assign('MODULE', 'Users');
$dotb_smarty->assign('ACTION', 'ChangePassword');
$dotb_smarty->assign('return_action', 'index');
$dotb_smarty->assign('APP_LIST', $app_list_strings);
$dotb_smarty->assign('config', $configurator->config);
$dotb_smarty->assign('error', $configurator->errors);
$dotb_smarty->assign('LANGUAGES', get_languages());
$dotb_smarty->assign('PWDSETTINGS', $GLOBALS['dotb_config']['passwordsetting']);
$dotb_smarty->assign('ID', $current_user->id);
$dotb_smarty->assign('IS_ADMIN', $current_user->is_admin);
$dotb_smarty->assign('USER_NAME', $current_user->user_name);
$dotb_smarty->assign("INSTRUCTION", $mod_strings['LBL_CHANGE_SYSTEM_PASSWORD']);
$dotb_smarty->assign('dotb_md',getWebPath('include/images/dotb_md_ent.png'));
if (!$current_user->is_admin) $dotb_smarty->assign('OLD_PASSWORD_FIELD','<td scope="row" width="30%">'.$mod_strings['LBL_OLD_PASSWORD'].':</td><td width="70%"><input type="password" size="26" tabindex="1" id="old_password" name="old_password"  value="" /></td>');
$pwd_settings=$GLOBALS['dotb_config']['passwordsetting'];


$pwd_regex=str_replace( "\\","\\\\",$pwd_settings['customregex']);
$dotb_smarty->assign("REGEX",$pwd_regex);
$rules = "'" . $pwd_settings["minpwdlength"] . "','" . $pwd_settings['maxpwdlength'] . "','" . $pwd_settings['customregex'] . "'";
$dotb_smarty->assign('SUBMIT_BUTTON',
	'<input title="'.$app_strings['LBL_SAVE_BUTTON_TITLE'].'" class="button" ' 
  . 'onclick="if (!set_password(form,newrules(' . $rules . '))) return false; this.form.saveConfig.value=\'1\';" ' 
  . 'type="submit" name="button" value="'.$app_strings['LBL_SAVE_BUTTON_LABEL'].'" />');


if (isset($_SESSION['expiration_type']) && $_SESSION['expiration_type'] != '')
	$dotb_smarty->assign('EXPIRATION_TYPE', $_SESSION['expiration_type']);/*
if ($current_user->system_generated_password == '1')
	$dotb_smarty->assign('EXPIRATION_TYPE', $mod_strings['LBL_PASSWORD_EXPIRATION_GENERATED']);*/
if(isset($_REQUEST['error_password'])) $dotb_smarty->assign('EXPIRATION_TYPE', $_REQUEST['error_password']);
$dotb_smarty->display('modules/Users/Changenewpassword.tpl');

?>