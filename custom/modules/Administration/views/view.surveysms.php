<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('include/MVC/View/DotbView.php');
require_once("include/DotbSmarty/Dotb_Smarty.php");
require_once 'custom/include/utilsfunction.php';

/**
 * generate report data and pass to report.tpl file
 *
 * @author     Original Author Biztech Co
 */
class ViewSurveySms extends DotbView {

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
            $custom_Sms_Settings = new Administration();
            $custom_Sms_Settings->retrieveSettings('SurveySms');
            $custom_sms_css_path = "custom/include/css/survey_css/survey.css";
            $dotbSmarty = new Dotb_Smarty();
            //changes regarding whatsapp data fetching
            $custom_setting = $custom_Sms_Settings->settings['SurveySms_survey_sms_fromdetails'];
            if (trim($custom_setting["sms"][1]["smsFromName"]) != "") {
                $isSmsSet = 1;
            } else {
                $isSmsSet = 0;
            }
            if (trim($custom_setting["whatsapp"][1]["wpFromName"]) != "") {
                $isWhatsppSet = 1;
            } else {
                $isWhatsppSet = 0;
            }
            $count = count($custom_setting["sms"]);
            $countWp = count($custom_setting["whatsapp"]);
            $dotbSmarty->assign("survey_sms_sid", $custom_Sms_Settings->settings['SurveySms_survey_sms_sid']);
            $dotbSmarty->assign("survey_sms_token", $custom_Sms_Settings->settings['SurveySms_survey_sms_token']);
            $dotbSmarty->assign("survey_sms_fromdetails", $custom_setting["sms"]);
            $dotbSmarty->assign("survey_wp_fromdetails", $custom_setting["whatsapp"]);
            $dotbSmarty->assign("survey_sms_fromdetailsLength", $count);
            $dotbSmarty->assign("survey_wp_fromdetailsLength", $countWp);
            $dotbSmarty->assign("isWhatsppSet", $isWhatsppSet);
            $dotbSmarty->assign("isSmsSet", $isSmsSet);
            $dotbSmarty->assign("APP", $app_strings);
            $dotbSmarty->assign('custom_sms_css_path', $custom_sms_css_path);
            $dotbSmarty->assign("MOD", return_module_language('en_us', 'EmailMan'));
            $dotbSmarty->display('custom/modules/Administration/tpl/survey_sms.tpl');

            parent::display();
        }
    }

}
