<?php

/**
 * The file used to set custom api related to survey actions
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
if (!defined('dotbEntry') || !dotbEntry)
    die('Not A Valid Entry Point');


require_once 'clients/base/api/ModuleApi.php';
require_once 'data/BeanFactory.php';
require_once('custom/biz/classes/Surveyutils.php');
require_once 'custom/include/utilsfunction.php';
include_once 'custom/include/pagination.class.php';

use Twilio\Rest\Client;

class bc_survey_sms_templateApi extends ModuleApi {

    public function registerApiRest() {
        return array(
            'get_survey_list' => array(
                'reqType' => 'POST',
                'path' => array('bc_survey_sms_template', 'get_survey_list'),
                'pathVars' => array('', ''),
                'method' => 'get_survey_list',
                'shortHelp' => 'Get reports for survey status',
                'longHelp' => '',
            ),
            'find_survey_sms_template_exist' => array(
                'reqType' => 'POST',
                'path' => array('bc_survey_sms_template', 'find_survey_sms_template_exist'),
                'pathVars' => array('', ''),
                'method' => 'find_survey_sms_template_exist',
                'shortHelp' => 'Find Survey sms template exsits',
                'longHelp' => '',
            ),
        );
    }

    /**
     * Function : getAllSurveyQuestions
     *   Retrieve all questions for Question Logic
     * 
     * @return array - $data
     */
    public function get_survey_list($api, $args) {
        global $db;
        $survey_id = $args['survey_id'];
        $GLOBALS['log']->fatal('This is the result : $survey_id', print_r($survey_id, 1));
        $sms_template_id = $args['record'];
        $GLOBALS['log']->fatal('This is the result : $sms_template_id', print_r($sms_template_id, 1));
        $selectSurveyQ = "SELECT * FROM bc_survey WHERE deleted = 0 AND survey_type = 'survey'";
        $SurveyDetails = $db->query($selectSurveyQ);

        $selectsms_templateQ = "SELECT sms_survey_linked FROM bc_survey_sms_template WHERE deleted = 0 AND id = '{$sms_template_id}'";
        $sms_templateDetails = $db->query($selectsms_templateQ);
        $sms_templateData = $db->fetchByAssoc($sms_templateDetails);
        $GLOBALS['log']->fatal('This is the result : ', print_r('', 1));
        $survey_id_selected = $sms_templateData['sms_survey_linked'];
        if ($survey_id_selected != "") {
            $selected_survey_id = $survey_id_selected;
        } else {
            $selected_survey_id = "";
        }
        $html = "";
        $html .= "<select id='survey_list'>";
        $html .= "<option value=''>Select Survey</option>";
        if ($survey_id_selected != "") {
            while ($surveyDataQ = $db->fetchByAssoc($SurveyDetails)) {
                if ($survey_id_selected == $surveyDataQ['id']) {
                    $html .= "<option value='" . $surveyDataQ['id'] . "' selected>" . $surveyDataQ['name'] . "</option>";
                } else {
                    $html .= "<option value='" . $surveyDataQ['id'] . "'>" . $surveyDataQ['name'] . "</option>";
                }
            }
        } else {
            if ($survey_id != "") {
                while ($surveyDataQ = $db->fetchByAssoc($SurveyDetails)) {
                    if ($survey_id == $surveyDataQ['id']) {
                        $html .= "<option value='" . $surveyDataQ['id'] . "'selected>" . $surveyDataQ['name'] . "</option>";
                    } else {
                        $html .= "<option value='" . $surveyDataQ['id'] . "'>" . $surveyDataQ['name'] . "</option>";
                    }
                }
            } else {
                while ($surveyDataQ = $db->fetchByAssoc($SurveyDetails)) {
                    $html .= "<option value='" . $surveyDataQ['id'] . "'>" . $surveyDataQ['name'] . "</option>";
                }
            }
        }
        $html .= "</select>";
        return array('html' => $html, 'selected_survey_id' => $selected_survey_id);
    }

    /**
     * Function : find_survey_sms_template_exist
     *   Find if survey SMS template exist
     * 
     * @return array - $data
     */
    public function find_survey_sms_template_exist($api, $args) {
        global $db;
        $survey_id = $args['survey_id'];
        $selectsms_templateQ = "SELECT * FROM bc_survey_sms_template WHERE deleted = 0 AND sms_survey_linked = '{$survey_id}'";
        $sms_templateDetails = $db->query($selectsms_templateQ);
        $sms_templateData = $db->fetchByAssoc($sms_templateDetails);
        $GLOBALS['log']->fatal('This is the result : $sms_templateData', print_r($sms_templateData, 1));
        if ($sms_templateData != "") {
            $selected_survey_id = "sms_template_exists";
        } else {
            $selected_survey_id = "sms_template_do_not_exists";
        }
        return array('selected_survey_id_template_exist' => $selected_survey_id);
    }

}
