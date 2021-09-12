<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


require('config.php');
global $dotb_config;
global $timedate;
global $mod_strings;

$Team = new Team();
$Team_id = $Team->retrieve_team_id('Administrator');

//Sent when the admin generate a new password
$EmailTemp = new EmailTemplate();
$EmailTemp->name = $mod_strings['advanced_password_new_account_email']['name'];
$EmailTemp->description = $mod_strings['advanced_password_new_account_email']['description'];
$EmailTemp->subject = $mod_strings['advanced_password_new_account_email']['subject'];
$EmailTemp->body = $mod_strings['advanced_password_new_account_email']['txt_body'];
$EmailTemp->body_html = $mod_strings['advanced_password_new_account_email']['body'];
$EmailTemp->deleted = 0;

$EmailTemp->team_id = $Team_id;
$EmailTemp->published = 'off';
$EmailTemp->type = 'system';
$EmailTemp->text_only = 0;
$id =$EmailTemp->save();
$dotb_config['passwordsetting']['generatepasswordtmpl'] = $id;

//User generate a link to set a new password
$EmailTemp = new EmailTemplate();
$EmailTemp->name = $mod_strings['advanced_password_forgot_password_email']['name'];
$EmailTemp->description = $mod_strings['advanced_password_forgot_password_email']['description'];
$EmailTemp->subject = $mod_strings['advanced_password_forgot_password_email']['subject'];
$EmailTemp->body = $mod_strings['advanced_password_forgot_password_email']['txt_body'];
$EmailTemp->body_html = $mod_strings['advanced_password_forgot_password_email']['body'];
$EmailTemp->deleted = 0;

$EmailTemp->team_id = $Team_id;
$EmailTemp->published = 'off';
$EmailTemp->type = 'system';
$EmailTemp->text_only = 0;
$id =$EmailTemp->save();
$dotb_config['passwordsetting']['lostpasswordtmpl'] = $id;

// set all other default settings
$dotb_config['passwordsetting']['forgotpasswordON'] = true;
$dotb_config['passwordsetting']['SystemGeneratedPasswordON'] = true;
$dotb_config['passwordsetting']['systexpirationtime'] = 7;
$dotb_config['passwordsetting']['systexpiration'] = 1;
$dotb_config['passwordsetting']['linkexpiration'] = true;
$dotb_config['passwordsetting']['linkexpirationtime'] = 24;
$dotb_config['passwordsetting']['linkexpirationtype'] = 60;
$dotb_config['passwordsetting']['minpwdlength'] = 6;
$dotb_config['passwordsetting']['oneupper'] = true;
$dotb_config['passwordsetting']['onelower'] = true;
$dotb_config['passwordsetting']['onenumber'] = true;

write_array_to_file("dotb_config", $dotb_config, "config.php");
