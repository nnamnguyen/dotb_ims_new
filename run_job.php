<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);

chdir(dirname(__FILE__));
define('ENTRY_POINT_TYPE', 'api');

require_once('include/entryPoint.php');

$sapi_type = php_sapi_name();
// Allow only CLI invocation
if (substr($sapi_type, 0, 3) != 'cli') {
    dotb_die("run_job.php is CLI only.");
}

if($argc < 3 || empty($argv[1]) || empty($argv[2])) {
    dotb_die("run_job.php requires job ID and client ID as parameters.");
}

if(empty($current_language)) {
	$current_language = $dotb_config['default_language'];
}

$app_list_strings = return_app_list_strings_language($current_language);
$app_strings = return_application_language($current_language);

$current_user = BeanFactory::newBean('Users');
$current_user->getSystemUser();

$GLOBALS['log']->debug('Starting job {$argv[1]} execution as ${argv[2]}');
$result = SchedulersJob::runJobId($argv[1], $argv[2]);

if(is_string($result)) {
    // something wrong happened
    echo $result;
    echo "\n";
    $result = false;
}

dotb_cleanup(false);
// some jobs have annoying habit of calling dotb_cleanup(), and it can be called only once
// but job results can be written to DB after job is finished, so we have to disconnect here again
// just in case we couldn't call cleanup
if(class_exists('DBManagerFactory')) {
	$db = DBManagerFactory::getInstance();
	$db->disconnect();
}

exit($result?0:1);