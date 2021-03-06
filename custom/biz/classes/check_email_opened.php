<?php

/**
 * The file used to handle checking of email is opened by client or not
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

$submission_id = $_REQUEST['submission_id'];
$submission = new bc_survey_submission();
$submission->retrieve($submission_id);
if (!empty($submission->id)) {
$submission->email_opened = 1;
$submission->save();
}

header('Content-Type: image/png');
echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
exit;