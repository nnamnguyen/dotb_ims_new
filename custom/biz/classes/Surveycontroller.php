<?php

/**
 * The file used to handle layout actions
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
require_once 'include/utils.php';
require_once 'custom/biz/classes/Surveyutils.php';
require_once 'modules/ModuleBuilder/parsers/parser.label.php';
require_once 'modules/ModuleBuilder/Module/StudioModuleFactory.php';
require_once 'modules/ModuleBuilder/parsers/views/GridLayoutMetaDataParser.php';

class Surveycontroller
{

    /**
     * Description :: This function is used to check license validation.
     *
     * @return bool '$result' - 1 - license validated
     *                          0 - license not validated
     */
    function outfitters_license()
    {
        if (empty($_REQUEST['method'])) {
            header('HTTP/1.1 400 Bad Request');
            $response = "method is required.";
            $json = getJSONobj();
            echo $json->encode($response);
        }
        echo "License validated";
    }

    function save_surveysmtp_setting()
    {
        require_once('modules/Administration/Administration.php');
        $administrationObj = new Administration();
        $administrationObj->saveSetting("SurveySmtp", "survey_notify_fromname", $_REQUEST['survey_notify_fromname']);
        $administrationObj->saveSetting("SurveySmtp", "survey_notify_fromaddress", $_REQUEST['survey_notify_fromaddress']);
        $administrationObj->saveSetting("SurveySmtp", "survey_smtp_email_provider", $_REQUEST['survey_smtp_email_provider']);
        $administrationObj->saveSetting("SurveySmtp", "survey_mail_smtp_host", $_REQUEST['survey_mail_smtp_host']);
        $administrationObj->saveSetting("SurveySmtp", "survey_mail_smtpport", $_REQUEST['survey_mail_smtpport']);
        $administrationObj->saveSetting("SurveySmtp", "survey_mail_smtpssl", $_REQUEST['survey_mail_smtpssl']);
        $administrationObj->saveSetting("SurveySmtp", "survey_mail_smtp_username", $_REQUEST['survey_mail_smtp_username']);
        $administrationObj->saveSetting("SurveySmtp", "survey_mail_smtp_password", $_REQUEST['survey_mail_smtp_password']);
        $administrationObj->saveSetting("SurveySmtp", "survey_mail_smtp_retype_password", $_REQUEST['survey_mail_smtp_retype_password']);

        header("Location: index.php?module=Administration&action=index");
        exit();
    }

    function save_surveysms_setting($api, $args)
    {
        require_once('modules/Administration/Administration.php');
        $administrationObj = new Administration();
        $administrationObj->saveSetting("SurveySms", "survey_sms_sid", $args['survey_sms_sid']);
        $administrationObj->saveSetting("SurveySms", "survey_sms_token", $args['survey_sms_token']);
        $administrationObj->saveSetting("SurveySms", "survey_sms_fromdetails", $args['survey_sms_fromdetails']);
        header("Location: index.php?module=Administration&action=index");
        return true;
    }

}
