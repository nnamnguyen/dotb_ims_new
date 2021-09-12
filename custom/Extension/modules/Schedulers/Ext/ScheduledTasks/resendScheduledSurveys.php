<?php

/**
 * The file used to set schedular job for re sending survey whose still not responded
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$job_strings[] = 'resendScheduledSurveys';

/**
 * Used to send survey after matching all conditions
 *
 * @return     bool TRUE - survey is send
 */
function resendScheduledSurveys() {
    require_once('custom/biz/classes/Surveyutils.php');
    require_once('include/DotbQuery/DotbQuery.php');

    $checkSurveySubscription = Surveyutils::validateSurveySubscription();
    if (!$checkSurveySubscription['success']) {
        return true;
    } else {
        // Re send scheduler execusion start
        $GLOBALS['log']->fatal("ReSendScheduleSurvey execution start : " . print_r('', 1));
        global $db, $timedate;
        $timedate->getInstance()->userTimezone(); // Time Zone
        $CurrenrDateTimeFinal = $timedate->now(); // Actual Time....
        // Retrieve resend allowed survey list
        $query = new DotbQuery();

        $query->select(array('id', 'recursive_email', 'resend_count', 'resend_interval'));

        $query->from(BeanFactory::getBean('bc_survey'));

        $query->where()->equals('recursive_email', 1);

        $results = $query->execute();
        // survey list

        foreach ($results as $key => $survey_detail) {
            if ($survey_detail['recursive_email'] == 1 && $survey_detail['resend_count'] > 0) {

                // get related survey submission
                $bc_survey = BeanFactory::getBean('bc_survey', $survey_detail['id']);
                $bc_survey->load_relationship('bc_survey_submission_bc_survey');

                foreach ($bc_survey->bc_survey_submission_bc_survey->getBeans() as $submission) {
                    $GLOBALS['log']->fatal("This is the submission  : " . print_r($submission->id, 1));
                    //compare date of scheduled on and current date
                    if ($submission->resend_counter < $survey_detail['resend_count'] && strtotime($submission->last_send_on) < strtotime($CurrenrDateTimeFinal) && $submission->status == 'Pending') {
                        $GLOBALS['log']->fatal("This is the schedule on less : " . ($submission->last_send_on) . " and current " . ($CurrenrDateTimeFinal) . " : " . print_r('', 1));
                        // check resend interval
                        if ($survey_detail['resend_interval'] == 'weekly') {
                            // schedule date formated
                            $scheduled_formated = date("Y-m-d", strtotime($submission->last_send_on));
                            $week_timestamp = strtotime('+7 day', strtotime($scheduled_formated)); // add week
                            $new_sched_date = date('Y-m-d', $week_timestamp);

                            // current check 
                            $new_curr_date = date("Y-m-d", strtotime($CurrenrDateTimeFinal));
                            // compare current date and possible to resend date if allowed to resend then update resend flag
                            if (strtotime($new_curr_date) >= strtotime($new_sched_date)) {
                                $GLOBALS['log']->fatal("allowed to resend : " . print_r('', 1));
                                $allowed_to_send = true;
                            } else {
                                $allowed_to_send = false;
                                $GLOBALS['log']->fatal("week not completed : " . print_r('', 1));
                            }
                        } else if ($survey_detail['resend_interval'] == 'monthly') {
                            // schedule date formated
                            $scheduled_formated = date("Y-m-d", strtotime($submission->last_send_on));
                            $week_timestamp = strtotime('+30 day', strtotime($scheduled_formated)); // add week
                            $new_sched_date = date('Y-m-d', $week_timestamp);

                            // current check 
                            $new_curr_date = date("Y-m-d", strtotime($CurrenrDateTimeFinal));
                            if (strtotime($new_curr_date) >= strtotime($new_sched_date)) {
                                $GLOBALS['log']->fatal("allowed to resend : " . print_r('', 1));
                                $allowed_to_send = true;
                            } else {
                                $allowed_to_send = false;
                                $GLOBALS['log']->fatal("month not completed : " . print_r('', 1));
                            }
                        }

                        // Re SEND survey if allowed to resend and interval completed
                        if ($allowed_to_send) {
                            reSendSurvey($submission, $survey_detail['id']);
                        }
                    }
                }
            } else {
                $GLOBALS['log']->fatal("This survey  {$survey_detail['id']}  has recursive email {$survey_detail['recursive_email']} nad resend count {$survey_detail['resend_count']} which is not applicable to resend.................... " . print_r('', 1));
            }
        }


        $GLOBALS['log']->fatal("Re -SendScheduleSurvey END : " . print_r('', 1));
        return true;
    }
}

function reSendSurvey($submission, $survey_id) {
    require_once 'custom/include/utilsfunction.php';
    global $dotb_config;
    $gmtdatetime = TimeDate::getInstance()->nowDb();
    $rec_module = $submission->target_parent_type;
    $target_parent_id = $submission->target_parent_id;

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
    $focus->retrieve($target_parent_id);
    $survey = new bc_survey();
    $survey->retrieve($survey_id);

    $recipient_type = $submission->recipient_as;
    $submission_type = $submission->submission_type;

    if ($submission_type == "Email") {
        if ($focus->email_opt_out == 0) {
            $moduleDetail = "&module_name=" . $rec_module . "&module_id=" . $target_parent_id;
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
                $replacing_url = $dotb_config['site_url'] . '/survey_submission.php?survey_id=SURVEY_PARAMS';

                // survey URL current with survey_id
                if (strpos($template_data['body_html'], 'href=') >= 1) {
                    $replacing_url = explode('"', substr($template_data['body_html'], strpos($template_data['body_html'], 'href=')));
                }
                //For QR code
                if (strpos($template_data['body_html'], 'src=') >= 1) {
                    $replacing_url_qr = explode('"', substr($template_data['body_html'], strpos($template_data['body_html'], 'src=')));
                }
                // host name
                if (strpos($template_data['body_html'], 'href=') >= 1) {
                    $host = strtok($replacing_url[1], '?');
                }
                //For QR code
                if (strpos($template_data['body_html'], 'src=') >= 1) {
                    $host = strtok($replacing_url_qr[1], '?');
                }
                // data to be encoded sufficient data
                //Change in the survey URL 10-12-2019
                $uid = $submission->email_survey_sumission_unique_id;
                $pure_data = $uid;
//            $pure_data = $survey->id . '&ctype=' . $rec_module . '&cid=' . $module_id.'&sub_id='.$submission->id;

                $encoded_data = base64_encode($pure_data);

                $new_url = $host . '?q=' . $encoded_data;

                //replace into current mail body for encoded survey URL
//                $template_data['body_html'] = str_replace($replacing_url, $new_url, $template_data['body_html']);
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

                $image_src = "{$dotb_config['site_url']}/index.php?entryPoint=checkEmailOpened&submission_id={$submission->id}";
                $image_url = "<img src='{$image_src}'>";
                $emailBody .= $image_url;
                $emailBody .= '<br/><span style="font-size:0.8em">To remove yourself from this email list  <a href="' . $opt_out_url . '" target="_blank">click here</a></span>';
                $sendMail = CustomSendEmail($to_Email, $emailSubject, $emailBody, $target_parent_id, $rec_module, $recipient_type);
                /*
                 * Store survey data
                 */
                $GLOBALS['log']->fatal("SendScheduleSurvey sent mail status : " . print_r($sendMail, 1));
                if (trim($sendMail) == 'send') {
                    // update resend date
                    $submission->last_send_on = $gmtdatetime;
                    if (empty($submission->resend_counter)) {
                        $resend_count = 0;
                    } else {
                        $resend_count = $submission->resend_counter;
                    }
                    $resend_counter = (int) $resend_count + 1;
                    $submission->resend_counter = $resend_counter; // update resend counter
                    $submission->mail_status = 'sent successfully';
                    $submission->survey_send = 1;
                    $submission->resend = 0;
                    $submission->save();
                    $GLOBALS['log']->fatal("Resend mail status : " . print_r($sendMail, 1));
                } else if (trim($sendMail) != 'send' && trim($sendMail) != 'notsend') {
                    $GLOBALS['log']->fatal("Resend mail status : " . print_r($sendMail, 1));
                    $submission->mail_status = $sendMail;
                    $submission->save();
                } else {
                    $GLOBALS['log']->fatal("Resend mail status : Mail Delievery Failed due to invalid email address" . print_r('', 1));
                    $submission->mail_status = 'Mail Delievery Failed due to invalid email address';
                    $submission->save();
                }
            } else {
                $submission->mail_status = 'Survey Sending Failed due to Email Template does not exists for given survey.';
                $submission->save();
                $GLOBALS['log']->fatal("Email Template does not exists for survey : " . print_r($survey->name, 1));
            }
        }
    } else if ($submission_type == "SMS" || $submission_type == "WhatsApp") {
        //Send survey link from SMS 10-12-2019
        $records = $submission->target_parent_id;
        $module_name = $submission->target_parent_type;
        $survey_id = $rec_module_detail['survey_id'];
        $field = $submission->to_be_sms_send_field;
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

        $custom_Sms_Settings = new Administration();
        $custom_Sms_Settings->retrieveSettings('SurveySms');
        $survey_sms_sid = $custom_Sms_Settings->settings['SurveySms_survey_sms_sid'];
        $survey_sms_token = $custom_Sms_Settings->settings['SurveySms_survey_sms_token'];
        $custom_setting = $custom_Sms_Settings->settings['SurveySms_survey_sms_fromdetails'];
        if ($submission_type['submission_type'] == "SMS") {
            $survey_sms_fromdetails = $custom_setting['sms'];
            $keys = 'sms';
        } else if ($submission_type['submission_type'] == "WhatsApp") {
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
                if ($smsValues['smsFromPhoneNumber'] == $args['fromNumber']) {
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
            if ($submission_type['submission_type'] == "SMS") {
                $sendSMS = sendSMS($survey_sms);
            } else if ($submission_type['submission_type'] == "WhatsApp") {
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
            $survey_submission->save();
        } else if (trim($sendSMS['success']) != 'send' && trim($sendSMS['success']) != 'notsend') {
            $survey_submission->mail_status = $sendSMS['success'];
            $isSendSuccess = $sendSMS['success'];
            $survey_submission->save();
        } else {
            $survey_submission->mail_status = 'Mail Delievery Failed due to invalid email address';
            $survey_submission->survey_send = 0;
            $survey_submission->save();
            $isSendSuccess = $sendSMS['success'];
        }
        $survey->survey_send_status = 'active';
        $survey->save();
    }
}
