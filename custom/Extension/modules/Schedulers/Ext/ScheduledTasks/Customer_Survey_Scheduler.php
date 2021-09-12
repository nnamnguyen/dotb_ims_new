<?php

/**
 * The file used to set schedular job for sending survey 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$job_strings[] = 'sendScheduledSurveys';

/**
 * Used to send survey after matching all conditions
 *
 * @return     bool TRUE - survey is send
 */
function sendScheduledSurveys() {
    require_once('custom/biz/classes/Surveyutils.php');
    $checkSurveySubscription = Surveyutils::validateSurveySubscription();
    if (!$checkSurveySubscription['success']) {
        return true;
    } else {
        $GLOBALS['log']->debug("SendScheduleSurvey execution start : " . print_r('', 1));
        global $dotb_config, $db;
        $date = TimeDate::getInstance()->nowDb();
        require_once 'custom/include/utilsfunction.php';
        $recipients = array();

        require_once('include/DotbQuery/DotbQuery.php');
        $query = new DotbQuery();
        $query->from(BeanFactory::getBean('bc_survey_submission'));

        $query->select(array("id", "target_parent_id", "target_parent_type", "survey_send", "submission_type", "to_be_sms_send_field"));
        $query->where()->lte('schedule_on', $date);
        //Take survey Changes 03-08-2019
        $query->where()->notEquals('submission_type', 'Manual');
        $query->where()->queryOr()->equals('resend', 1)->equals('survey_send', 0);
        $query->limit(150);

        $scDataQryRes = $query->execute();

        /*      $scDataQry = "SELECT
          submission.id as submission_id,
          submission.target_parent_id,
          submission.target_parent_type,
          submission.survey_send,
          bc_survey.id AS survey_id
          FROM `bc_survey_submission` AS submission
          INNER JOIN bc_survey_submission_bc_survey_c AS relation
          ON relation.bc_survey_submission_bc_surveybc_survey_submission_idb = submission.id
          AND relation.deleted = 0
          INNER JOIN bc_survey
          ON bc_survey.id = relation.bc_survey_submission_bc_surveybc_survey_ida
          AND bc_survey.deleted = 0
          WHERE   (submission.schedule_on <= '{$date}' AND submission.survey_send = 0 )
          OR (submission.schedule_on <= '{$date}' AND submission.resend = 1 AND submission.status != 'Submitted' )
          LIMIT 150";
          $scDataQryRes = $db->query($scDataQry);
          $cnt = 0; */
        $cnt = 0;
        foreach ($scDataQryRes as $scDataQryResult) {
            $recipients[$scDataQryResult['target_parent_type']][$cnt]['target_parent_id'] = $scDataQryResult['target_parent_id'];
            $oSubmission = BeanFactory::getBean('bc_survey_submission', $scDataQryResult['id']);
            $sID1 = $oSubmission->bc_survey_submission_bc_survey->focus->bc_survey_submission_bc_surveybc_survey_ida;
            $sID2 = $oSubmission->bc_survey_submission_bc_surveybc_survey_ida;
            $survey_id = ($sID1 == null) ? $sID2 : $sID1;
            $recipients[$scDataQryResult['target_parent_type']][$cnt]['survey_id'] = $survey_id;
            $recipients[$scDataQryResult['target_parent_type']][$cnt]['submission_id'] = $scDataQryResult['id'];
            $recipients[$scDataQryResult['target_parent_type']][$cnt]['submission_type'] = $scDataQryResult['submission_type'];
            $recipients[$scDataQryResult['target_parent_type']][$cnt]['to_be_sms_send_field'] = $scDataQryResult['to_be_sms_send_field'];
            $cnt++;
        }

        $GLOBALS['log']->debug("SendSchedultSurvey get recipient : " . print_r($recipients, 1));
        foreach ($recipients as $rec_module => $rec_module_ids) {
            foreach ($rec_module_ids as $rec_module_detail) {
                switch ($rec_module) {
                    case "Accounts":
                        $focus = new Account();
                        $recip_prefix = '$account';
                        break;
                    case "Contacts":
                        $focus = new Contact();
                        $recip_prefix = '$contact';
                        break;
                    case "Leads":
                        $focus = new Lead();
                        $recip_prefix = '$contact';
                        break;
                    case "Prospects":
                        $focus = new Prospect();
                        $recip_prefix = '$contact';
                        break;
                }
                $focus->retrieve($rec_module_detail['target_parent_id']);
                $survey = new bc_survey();
                $survey->retrieve($rec_module_detail['survey_id']);

                // Survey Status :: LoadedTech Customization
                if ($survey->survey_status == 'Active') {
                    if ($rec_module_detail['submission_type'] == "Email") {
                        $survey_submission = new bc_survey_submission();
                        $survey_submission->retrieve($rec_module_detail['submission_id']);
                        $recipient_type = $survey_submission->recipient_as;

                        if ($focus->email_opt_out == 0) {
                            $moduleDetail = "&module_name=" . $rec_module . "&module_id=" . $rec_module_detail['target_parent_id'];
                            $encodedData = base64_encode($moduleDetail);
                            $opt_out_url = $dotb_config['site_url'] . '/index.php?entryPoint=unsubscribe&q=' . $encodedData;
                            $getSurveyEmailTemplateID = getEmailTemplateBySurveyID($survey->id);
                            $emailtemplateObj = new EmailTemplate();
                            $emailtemplateObj->retrieve($getSurveyEmailTemplateID);
                            // Check email template exists or not
                            if (!empty($emailtemplateObj->id)) {
                                $macro_nv = array();
                                $emailtemplateObj->parsed_entities = null;
                                $emailSubjectName = (!empty($emailtemplateObj->subject)) ? $emailtemplateObj->subject : $survey->name;
                                if ($rec_module == 'Leads' || $rec_module == 'Prospects') {
                                    $email_module = 'Contacts';
                                } else {
                                    $email_module = $rec_module;
                                }

                                //replace prefix for recipient name if exists email template for other module
                                if ($recip_prefix == '$contact') {
                                    $search_prefix1 = '$account';
                                    $search_prefix2 = '$contact_user';
                                } else if ($recip_prefix == '$account') {
                                    $search_prefix1 = '$contact';
                                    $search_prefix2 = '$contact_user';
                                }

                                $emailtemplateObj->body_html = str_replace($search_prefix1, $recip_prefix, $emailtemplateObj->body_html);
                                $emailtemplateObj->body_html = str_replace($search_prefix2, $recip_prefix, $emailtemplateObj->body_html);

                                $template_data = $emailtemplateObj->parse_email_template(array(
                                    "subject" => $emailSubjectName,
                                    "body_html" => $emailtemplateObj->body_html,
                                    "body" => $emailtemplateObj->body), $email_module, $focus, $macro_nv);

                                // create new url for survey with encryption*****************************************

                                $module_id = $focus->id; // module record id
                                // survey URL current with survey_id
                                // Code change Based On Jason COmment On 14-05-2019
                                // Email Subject: Survey Rocket - send survey scheduler not replacing SURVEY_PARAMS variable
                                //  $survey_url = explode('"', substr($template_data['body_html'], strpos($template_data['body_html'], 'href=')));
                                $replacing_url = $dotb_config['site_url'] . '/survey_submission.php?survey_id=SURVEY_PARAMS';
                                // survey URL current with survey_id 13 feb 2020
                                if (strpos($template_data['body_html'], 'href=') >= 1) {
                                    $replacing_url = explode('"', substr($template_data['body_html'], strpos($template_data['body_html'], 'href=')));
                                }
                                //For QR code 13 feb 2020
                                if (strpos($template_data['body_html'], 'src=') >= 1) {
                                    $replacing_url_qr = explode('"', substr($template_data['body_html'], strpos($template_data['body_html'], 'src=')));
                                }
                                // host name 13 feb 2020
                                if (strpos($template_data['body_html'], 'href=') >= 1) {
                                    $host = strtok($replacing_url[1], '?');
                                }
                                //For QR code 13 feb 2020
                                if (strpos($template_data['body_html'], 'src=') >= 1) {
                                    $host = strtok($replacing_url_qr[1], '?');
                                }
                                // host name
                                //  $host = strtok($survey_url[1], '?');
                                // data to be encoded sufficient data
                                //Change in the survey URL 10-12-2019
                                $GLOBALS['log']->fatal('This is the result : Customer_Survey_Scheduler.php');
                                $uid = $survey_submission->email_survey_sumission_unique_id;
                                $pure_data = $uid;
//                            $pure_data = $survey->id . '&ctype=' . $rec_module . '&cid=' . $module_id . '&sub_id=' . $survey_submission->id;

                                $encoded_data = base64_encode($pure_data);

                                //  $new_url = $host . '?q=' . $encoded_data;
                                $new_url = $host . '?q=' . $encoded_data;

                                //replace into current mail body for encoded survey URL
//                                $template_data['body_html'] = str_replace($replacing_url, $new_url, $template_data['body_html']);
                                if (strpos($template_data['body_html'], 'href=') >= 1) {
                                    $template_data['body_html'] = str_replace($replacing_url[1], $new_url, $template_data['body_html']);
                                }
                                //For QR code
                                if (strpos($template_data['body_html'], 'src=') >= 1) {
                                    $qr_url = genrateQRCode($new_url);
                                    $template_data['body_html'] = str_replace($replacing_url_qr[1], $qr_url, $template_data['body_html']);
                                }

                                // **************************************************************************************

                                $emailBody = $template_data["body_html"];
                                $mailSubject = $template_data["subject"];

                                $emailSubject = $mailSubject;
                                $to_Email = $focus->email1;

                                $image_src = "{$dotb_config['site_url']}/index.php?entryPoint=checkEmailOpened&submission_id={$rec_module_detail['submission_id']}";
                                $image_url = "<img src='{$image_src}'>";
                                $emailBody .= $image_url;
                                $emailBody .= '<br/><span style="font-size:0.8em">To remove yourself from this email list  <a href="' . $opt_out_url . '" target="_blank">click here</a></span>';
                                $sendMail = CustomSendEmail($to_Email, $emailSubject, $emailBody, $rec_module_detail['target_parent_id'], $rec_module, $recipient_type);
                                /*
                                 * Store survey data
                                 */
                                $GLOBALS['log']->debug("SendScheduleSurvey sent mail status : " . print_r($sendMail, 1));
                                if (trim($sendMail) == 'send') {
                                    $survey_submission->last_send_on = $date;
                                    $survey_submission->mail_status = 'sent successfully';
                                    $survey_submission->survey_send = 1;
                                    if ($survey_submission->resend == 1) {
                                        $resend_counter = (int) $survey_submission->resend_counter + 1;
                                        $survey_submission->resend_counter = $resend_counter;
                                    }
                                    $survey_submission->resend = 0;
                                    $survey_submission->save();
                                } else if (trim($sendMail) != 'send' && trim($sendMail) != 'notsend') {
                                    $survey_submission->mail_status = $sendMail;
                                    $survey_submission->save();
                                } else {
                                    $survey_submission->mail_status = 'Mail Delievery Failed due to invalid email address';
                                    $survey_submission->save();
                                }

                                $survey->survey_send_status = 'active';
                                $survey->save();
                            } else {
                                $survey_submission = new bc_survey_submission();
                                $survey_submission->retrieve($rec_module_detail['submission_id']);
                                $survey_submission->mail_status = 'Survey Sending Failed due to Email Template does not exists for given survey.';
                                $survey_submission->save();
                                $GLOBALS['log']->debug("Email Template does not exists for survey : " . print_r($survey->name, 1));
                            }
                        }
                    } else if ($rec_module_detail['submission_type'] == "SMS" || $rec_module_detail['submission_type'] == "WhatsApp") {
                        //Send survey link from SMS 10-12-2019
                        $records = $rec_module_detail['target_parent_id'];
                        $module_name = $rec_module_detail['target_parent_type'];
                        $survey_id = $rec_module_detail['survey_id'];
                        $field = $rec_module_detail['to_be_sms_send_field'];

                        /* Do same for sms template module */
                        $template_id = getSMSTemplateBySurveyID($survey_id);
                        $smstemplateObj = new bc_survey_sms_template();
                        $smstemplateObj->retrieve($template_id['smsTemplateID']);
                        //retrieve survey title
                        $oSurvey = new bc_survey();
                        $oSurvey->retrieve($survey_id);
                        $survey_title = $oSurvey->name;

                        //replace prefix for recipient name if exists email template for other module
                        if ($module_name == $smstemplateObj->sms_sync_module_list) {
                            $sync_module = $smstemplateObj->sms_sync_module_list;
                            $sync_field = $smstemplateObj->sms_field_name;
                            $toBeReplacedSting = '$' . $sync_module . '_' . $sync_field;
                            $replacedSting = $focus->$sync_field;
                            $sms_content = str_replace($toBeReplacedSting, $replacedSting, $smstemplateObj->sms_content);
                        } else {
                            $sms_content = $smstemplateObj->sms_content;
                        }
                        // create new url for survey with encryption*****************************************
                        $module_id = $focus->id; // module record id
                        // survey URL 
                        $host = $dotb_config['site_url'] . "/survey_submission.php";
                        // data to be encoded sufficient data
                        $survey_submission = new bc_survey_submission();
                        $survey_submission->retrieve($rec_module_detail['submission_id']);
                        $uid = $survey_submission->email_survey_sumission_unique_id;
                        $pure_data = $uid;
                        $encoded_data = base64_encode($pure_data);
                        $new_url = $encoded_data;
                        $survey_url = $host . '?q=' . $encoded_data;
                        $sms_content = str_replace('$survey_link', $new_url, $sms_content);

                        $GLOBALS['log']->fatal('This is the result : $new_url$new_url', print_r($new_url, 1));

                        $custom_Sms_Settings = new Administration();
                        $custom_Sms_Settings->retrieveSettings('SurveySms');
                        $survey_sms_sid = $custom_Sms_Settings->settings['SurveySms_survey_sms_sid'];
                        $survey_sms_token = $custom_Sms_Settings->settings['SurveySms_survey_sms_token'];
                        $custom_setting = $custom_Sms_Settings->settings['SurveySms_survey_sms_fromdetails'];
                        if ($rec_module_detail['submission_type'] == "SMS") {
                            $survey_sms_fromdetails = $custom_setting['sms'];
                            $keys = 'sms';
                        } else if ($rec_module_detail['submission_type'] == "WhatsApp") {
                            $survey_sms_fromdetails = $custom_setting['whatsapp'];
                            $keys = 'wp';
                        }
                        if ($args['fromNumber'] == "") {
                            foreach ($survey_sms_fromdetails as $sms_key => $smsValues) {
                                if ($smsValues['defaultNumber'] == "default") {
                                    $survey_sms_fromName = $smsValues[$keys . 'FromName'];
                                    $survey_sms_fromPhoneNumber = $smsValues[$keys . 'FromPhoneNumber'];
                                }
                            }
                        } else {
                            foreach ($survey_sms_fromdetails as $sms_key => $smsValues) {
                                if ($smsValues[$keys . 'FromPhoneNumber'] == $args['fromNumber']) {
                                    $survey_sms_fromName = $smsValues[$keys . 'FromName'];
                                    $survey_sms_fromPhoneNumber = $smsValues[$keys . 'FromPhoneNumber'];
                                }
                            }
                        }
                        $survey_sms = array();
                        $survey_sms['survey_sms_sid'] = $survey_sms_sid;
                        $survey_sms['survey_sms_token'] = $survey_sms_token;
                        $survey_sms['survey_sms_fromName'] = $survey_sms_fromName;
                        $survey_sms['survey_sms_fromPhoneNumber'] = $survey_sms_fromPhoneNumber;
                        $survey_sms['survey_sms_doNotReply'] = $survey_sms_doNotReply;
                        $survey_sms['message'] = $sms_content;
                        $survey_sms['fields'] = $field;
                        $survey_sms['record_id'] = $records;
                        if (!empty($survey_sms_sid) && !empty($survey_sms_token) && !empty($survey_sms_fromPhoneNumber)) {
                            if ($rec_module_detail['submission_type'] == "SMS") {
                                $sendSMS = sendSMS($survey_sms);
                            } else if ($rec_module_detail['submission_type'] == "WhatsApp") {
                                $sendSMS = sendWhatsApp($survey_sms, $rec_module_detail['submission_id'], $survey_url);
                            }
                        }


//            $sendMail = CustomSendEmail($to_Email, $emailSubject, $emailBody, $args['records'], $args['module_name'], '');
                        /*
                         * Store survey data
                         */
                        if (trim($sendSMS['success']) == 'send') {
                            $survey_submission->last_send_on = $date;
                            $survey_submission->mail_status = 'sms sent successfully';
                            $survey_submission->survey_send = 1;
                            if ($survey_submission->resend == 1) {
                                $resend_counter = (int) $survey_submission->resend_counter + 1;
                                $survey_submission->resend_counter = $resend_counter;
                            }
                            $survey_submission->resend = 0;
                            if ($rec_module_detail['submission_type'] == "WhatsApp") {
                                $send_number = josn_decode($survey_submission->to_be_sms_send_field);
                            }
                            $survey_submission->save();
                        } else if (trim($sendSMS['success']) != 'send' && trim($sendSMS['success']) != 'notsend') {
                            $survey_submission->mail_status = $sendSMS['success'];
                            $isSendSuccess = $sendSMS['success'];
                            if ($rec_module_detail['submission_type'] == "WhatsApp") {
                                $send_number = josn_decode($survey_submission->to_be_sms_send_field);
                            }
                            $survey_submission->save();
                        } else {
                            $survey_submission->mail_status = 'Mail Delievery Failed due to invalid email address';
                            $survey_submission->survey_send = 0;
                            if ($rec_module_detail['submission_type'] == "WhatsApp") {
                                $send_number = josn_decode($survey_submission->to_be_sms_send_field);
                            }
                            $survey_submission->save();
                            $isSendSuccess = $sendSMS['success'];
                        }
                        $survey->survey_send_status = 'active';
                        $survey->save();
                    }
                }
                //  Survey Status :: LoadedTech Customization
                else {
                    $GLOBALS['log']->debug("SendScheduleSurvey :: This survey has been deactivated : $survey->name");
                }
                // Survey Status :: LoadedTech Customization END
            }
        }
        $GLOBALS['log']->debug("SendScheduleSurvey END : " . print_r('', 1));
        return true;
    }
}
