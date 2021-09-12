<?php


global $mod_strings;
global $current_user;

$default = 'index.php?module=Emails&action=ListView&assigned_user_id='.$current_user->id;

$e = BeanFactory::newBean('Emails');

// my inbox
if(ACLController::checkAccess('Emails', 'edit', true)) {
	$module_menu[] = array('index.php?module=Emails&action=index', $mod_strings['LNK_VIEW_MY_INBOX'],"EmailFolder","Emails");
}
// create email template
if(ACLController::checkAccess('EmailTemplates', 'edit', true)) $module_menu[] = array("index.php?module=EmailTemplates&action=EditView&return_module=EmailTemplates&return_action=DetailView", $mod_strings['LNK_NEW_EMAIL_TEMPLATE'],"CreateEmails","Emails");
// email templates
if(ACLController::checkAccess('EmailTemplates', 'list', true)) $module_menu[] = array("index.php?module=EmailTemplates&action=index", $mod_strings['LNK_EMAIL_TEMPLATE_LIST'],"EmailFolder", 'Emails');
?>
