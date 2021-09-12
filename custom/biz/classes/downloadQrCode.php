<?php

if (!defined('dotbEntry') || !dotbEntry)
    define('dotbEntry', true);

require_once('include/entryPoint.php');
require_once 'custom/include/utilsfunction.php';
global $current_user;
$GLOBALS['log']->fatal('This is the result : $_REQUEST', print_r($_REQUEST, 1));
$GLOBALS['log']->fatal('This is the result : Testing');
$qr_code_link = html_entity_decode($_REQUEST['qr_url']);
$GLOBALS['log']->fatal('This is the result : $qr_code_link', print_r($qr_code_link, 1));
$survey_name = $_REQUEST['qr_survey_name'];
$imageData = get_url_contents($qr_code_link);
$GLOBALS['log']->fatal('This is the result : $imageData', print_r($imageData, 1));
$fileName = str_replace(' ', '_', $survey_name);
$QrCode = $fileName . '.png';
    header('Content-Description: File Transfer');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
header("Content-Disposition: attachment;filename={$QrCode}");
    header('Content-Type: application/force-download');
echo $imageData;
    exit;

