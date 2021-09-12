<?php
if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


$modListHeader = array();
require_once('include/modules.php');
require_once('config.php');

/** @var Localization $locale */
global $dotb_config,
       $current_language,
       $app_list_strings,
       $app_strings,
       $locale,
       $timedate;

$language         = $dotb_config['default_language']; // here we'd better use English, because pdf coding problem.
$app_list_strings = return_app_list_strings_language($language);
$app_strings      = return_application_language($language);

$reportSchedule = new ReportSchedule();
$reportSchedule->handleFailedReports();
$reportsToEmail = $reportSchedule->get_reports_to_email();

global $report_modules,
       $modListHeader,
       $current_user;

$queue = new DotbJobQueue();
foreach ($reportsToEmail as $scheduleInfo) {
    $job = BeanFactory::newBean('SchedulersJobs');
    $job->name = 'Send Scheduled Report ' . $scheduleInfo['report_id'];
    $job->assigned_user_id = $scheduleInfo['user_id'];
    $job->target = 'class::DotbJobSendScheduledReport';
    $job->data = $scheduleInfo['id'];
    $job->job_group = $scheduleInfo['report_id'];
    $queue->submitJob($job);
}

DBManagerFactory::getInstance()->commit();
