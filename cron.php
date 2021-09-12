<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);

//change directories to where this file is located.
chdir(dirname(__FILE__));
define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');

$sapi_type = php_sapi_name();
if (substr($sapi_type, 0, 3) != 'cli') {
    dotb_die("cron.php is CLI only.");
}

DotbMetric_Manager::getInstance()->setMetricClass('background')->setTransactionName('cron');

if(empty($current_language)) {
	$current_language = $dotb_config['default_language'];
}

$app_list_strings = return_app_list_strings_language($current_language);
$app_strings = return_application_language($current_language);

global $current_user;
$current_user = BeanFactory::newBean('Users');
$current_user->getSystemUser();

$GLOBALS['log']->debug('--------------------------------------------> at cron.php <--------------------------------------------');
$cron_driver = !empty($dotb_config['cron_class'])?$dotb_config['cron_class']:'DotbCronJobs';
$GLOBALS['log']->debug("Using $cron_driver as CRON driver");

DotbAutoLoader::requireWithCustom("include/DotbQueue/$cron_driver.php");

$jobq = new $cron_driver();
$jobq->runCycle();

$exit_on_cleanup = true;

dotb_cleanup(false);
// some jobs have annoying habit of calling dotb_cleanup(), and it can be called only once
// but job results can be written to DB after job is finished, so we have to disconnect here again
// just in case we couldn't call cleanup
if(class_exists('DBManagerFactory')) {
	$db = DBManagerFactory::getInstance();
	$db->disconnect();
}

// If we have a session left over, destroy it
if(session_id()) {
    session_destroy();
}

if($exit_on_cleanup) exit($jobq->runOk()?0:1);
