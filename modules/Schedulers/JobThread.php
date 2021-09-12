<?php


if(!empty($_REQUEST['job_id'])) {
	
	
	$job_id = $_REQUEST['job_id'];

	if(empty($GLOBALS['log'])) { // setup logging
		
		$GLOBALS['log'] = LoggerManager::getLogger('DotBCRM');
	}
	ob_implicit_flush();
	ignore_user_abort(true);// keep processing if browser is closed
	set_time_limit(0);// no time out
    $db = DBManagerFactory::getInstance();
	$GLOBALS['log']->debug('Job [ '.$job_id.' ] is about to FIRE. Updating Job status in DB');
    $qLastRun = "UPDATE schedulers SET last_run = " .
        $db->quoted($runTime) .
        " WHERE id = " .
        $db->quoted($job_id);
    $db->query($qLastRun);
	
	$job = new Job();
	$job->runtime = TimeDate::getInstance()->nowDb();
	if($job->startJob($job_id)) {
		$GLOBALS['log']->info('----->Job [ '.$job_id.' ] was fired successfully');
	} else {
		$GLOBALS['log']->fatal('----->Job FAILURE job [ '.$job_id.' ] could not complete successfully.');
	}
	
	$GLOBALS['log']->debug('Job [ '.$a['job'].' ] has been fired - dropped from schedulers_times queue and last_run updated');
	$this->finishJob($job_id);
	return true;
} else {
	$GLOBALS['log']->fatal('JOB FAILURE JobThread.php called with no job_id.  Suiciding this thread.');
	die();
}
?>
