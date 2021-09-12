<?php

/**
 * The file used to handle survey submission form 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
if (!defined('dotbEntry') || !dotbEntry)
    define('dotbEntry', true);

global $dotb_config, $db;

$whatsapp_send_response_sid = $_REQUEST['SmsSid'];
$status = $_REQUEST['MessageStatus'];
$GLOBALS['log']->fatal('This is the result : ', print_r('', 1));
//Submission id Selection
$selSub = "SELECT * FROM bc_survey_submission WHERE whatsapp_send_response_sid LIKE '%{$whatsapp_send_response_sid}%'";
$resQry = $db->query($selSub);
$subData = $db->fetchByAssoc($resQry);
$sub_id = $subData['id'];
$sub_send_status = $subData['whatsapp_message_status'];
$to_be_sms_send_field = json_decode(html_entity_decode($subData['to_be_sms_send_field']), true);

if ($status == "failed") {
    foreach ($to_be_sms_send_field as $field_name => $number) {
        if ($number == $_REQUEST["ChannelToAddress"]) {
            unset($to_be_sms_send_field[$field_name]);
        }
    }
    if (empty($to_be_sms_send_field) && ($sub_send_status != "sent" && $sub_send_status != "read" && $sub_send_status != "delivered")) {
        $updateQueryStatus = "UPDATE bc_survey_submission SET whatsapp_message_status='{$status}' WHERE id= '{$sub_id}';";
        $db->query($updateQueryStatus);
    }

    $to_be_sms_send_fieldNew = json_encode($to_be_sms_send_field);
    $updateQueryNumberField = "UPDATE bc_survey_submission SET to_be_sms_send_field='{$to_be_sms_send_fieldNew}' WHERE id= '{$sub_id}';";
    $db->query($updateQueryNumberField);
} else {
    if ($status == "sent" && $sub_send_status != "read" && $sub_send_status != "delivered") {
        $updateQuery = "UPDATE bc_survey_submission SET whatsapp_message_status='{$status}' WHERE id= '{$sub_id}';";
        $db->query($updateQuery);
    } else if ($status == "delivered" && $sub_send_status != "read") {
        $updateQuery = "UPDATE bc_survey_submission SET whatsapp_message_status='{$status}' WHERE id= '{$sub_id}';";
        $db->query($updateQuery);
    } else if ($status == "read" && $sub_send_status != "read") {
        $updateQuery = "UPDATE bc_survey_submission SET whatsapp_message_status='{$status}' WHERE id= '{$sub_id}';";
        $db->query($updateQuery);
    } else if ($status != "failed" && $sub_send_status == "failed" && $sub_send_status != "read" && $sub_send_status != "delivered" && $sub_send_status != "sent") {
        $updateQuery = "UPDATE bc_survey_submission SET whatsapp_message_status='{$status}' WHERE id= '{$sub_id}';";
        $db->query($updateQuery);
    }
}

