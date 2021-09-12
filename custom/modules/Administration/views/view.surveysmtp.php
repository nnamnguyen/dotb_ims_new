<?php

/**
 * Send All submission Data To report.tpl file
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Original Author Biztech Co.
 */
require_once('include/MVC/View/DotbView.php');
require_once("include/DotbSmarty/Dotb_Smarty.php");
require_once 'custom/include/utilsfunction.php';

/**
 * generate report data and pass to report.tpl file
 *
 * @author     Original Author Biztech Co
 */
class ViewSurveySmtp extends DotbView {

    function display() {

        global $app_strings, $mod_strings, $current_user, $dotb_config;
        require_once 'custom/biz/classes/Surveyutils.php';
        $checkSurveySubscription = Surveyutils::validateSurveySubscription();

        if (!$checkSurveySubscription['success']) {
            if (!empty($checkSurveySubscription['message'])) {
                // license not validated
                echo '<div style="color: #F11147;text-align: center;background: #FAD7EC;padding: 10px;margin: 3% auto;width: 70%;top: 50%;left: 0;right: 0;border: 1px solid #F8B3CC;font-size : 14px;">' . $checkSurveySubscription['message'] . '</div>';
            }
        } else {
            $custom_Smtp_Settings = new Administration();
            $custom_Smtp_Settings->retrieveSettings('SurveySmtp');
            $custom_smtp_css_path =  "custom/include/css/survey_css/survey.css";
            $dotbSmarty = new Dotb_Smarty();
            $survey_smtp_email_provider = (empty($custom_Smtp_Settings->settings['SurveySmtp_survey_smtp_email_provider'])) ? 'other' : $custom_Smtp_Settings->settings['SurveySmtp_survey_smtp_email_provider'];
            $dotbSmarty->assign("mail_sendtype", $custom_Smtp_Settings->settings['mail_sendtype']);
            $dotbSmarty->assign("survey_notify_fromname", $custom_Smtp_Settings->settings['SurveySmtp_survey_notify_fromname']);
            $dotbSmarty->assign("survey_notify_fromaddress", $custom_Smtp_Settings->settings['SurveySmtp_survey_notify_fromaddress']);
            $dotbSmarty->assign("survey_smtp_email_provider", $survey_smtp_email_provider);
            $dotbSmarty->assign("survey_mail_smtp_host", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtp_host']);
            $dotbSmarty->assign("survey_mail_smtpport", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtpport']);
            $dotbSmarty->assign("survey_mail_smtpssl", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtpssl']);
            $dotbSmarty->assign("survey_mail_smtp_smtpauth_req", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtp_smtpauth_req']);
            $dotbSmarty->assign("survey_mail_smtp_username", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtp_username']);
            $dotbSmarty->assign("survey_mail_smtp_password", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtp_password']);
            $dotbSmarty->assign("survey_mail_smtp_retype_password", $custom_Smtp_Settings->settings['SurveySmtp_survey_mail_smtp_retype_password']);
            $dotbSmarty->assign("APP", $app_strings);
            $dotbSmarty->assign('custom_smtp_css_path', $custom_smtp_css_path);
            $dotbSmarty->assign("MOD", return_module_language('en_us', 'EmailMan'));
            $dotbSmarty->display('custom/modules/Administration/tpl/survey_smtp.tpl');

            parent::display();
        }
    }

}
