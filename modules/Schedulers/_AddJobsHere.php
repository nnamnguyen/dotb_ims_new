<?php


use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Job\RebuildJob;

/**
 * Set up an array of Jobs with the appropriate metadata
 * 'jobName' => array (
 * 		'X' => 'name',
 * )
 * 'X' should be an increment of 1
 * 'name' should be the EXACT name of your function
 *
 * Your function should not be passed any parameters
 * Always  return a Boolean. If it does not the Job will not terminate itself
 * after completion, and the webserver will be forced to time-out that Job instance.
 * DO NOT USE dotb_cleanup(); in your function flow or includes.  this will
 * break Schedulers.  That function is called at the foot of cron.php
 */

/**
 * This array provides the Schedulers admin interface with values for its "Job"
 * dropdown menu.
 */
$job_strings = array (
	0 => 'refreshJobs',
	1 => 'pollMonitoredInboxes',
	2 => 'runMassEmailCampaign',
    5 => 'pollMonitoredInboxesForBouncedCampaignEmails',
	3 => 'pruneDatabase',
	4 => 'trimTracker',
	/*4 => 'securityAudit()',*/
    6 => 'processWorkflow',
	7 => 'processQueue',
    9 => 'updateTrackerSessions',
    12 => 'sendEmailReminders',
    15 => 'cleanJobQueue',
    //Add class to build additional TimePeriods as necessary
    16 => 'class::DotbJobCreateNextTimePeriod',
    20 => 'cleanOldRecordLists',
    21 => 'class::DotbJobRemovePdfFiles',
    22 => 'class::DotbJobKBContentUpdateArticles',
    23 => 'class::\Dotbcrm\Dotbcrm\Elasticsearch\Queue\Scheduler',
    24 => 'class::DotbJobRemoveDiagnosticFiles',
    25 => 'class::DotbJobRemoveTmpFiles',
    26 => 'class::' . RebuildJob::class,
);

/**
 * Job 0 refreshes all job schedulers at midnight
 * DEPRECATED
 */
function refreshJobs() {
	return true;
}


/**
 * Job 1
 */
function pollMonitoredInboxes() {

    $_bck_up = array('team_id' => $GLOBALS['current_user']->team_id, 'team_set_id' => $GLOBALS['current_user']->team_set_id);
	$GLOBALS['log']->info('----->Scheduler fired job of type pollMonitoredInboxes()');
	global $dictionary;
	global $app_strings;



	$ie = BeanFactory::newBean('InboundEmail');
	$emailUI = new EmailUI();
	$r = $ie->db->query('SELECT id, name FROM inbound_email WHERE is_personal = 0 AND deleted=0 AND status=\'Active\' AND mailbox_type != \'bounce\'');
	$GLOBALS['log']->debug('Just got Result from get all Inbounds of Inbound Emails');

	while($a = $ie->db->fetchByAssoc($r)) {
		$GLOBALS['log']->debug('In while loop of Inbound Emails');
		$ieX = BeanFactory::getBean('InboundEmail', $a['id'], array('disable_row_level_security' => true));
        $GLOBALS['current_user']->team_id = $ieX->team_id;
        $GLOBALS['current_user']->team_set_id = $ieX->team_set_id;
		$mailboxes = $ieX->mailboxarray;
		foreach($mailboxes as $mbox) {
			$ieX->mailbox = $mbox;
			$newMsgs = array();
			$msgNoToUIDL = array();
			$connectToMailServer = false;
			if ($ieX->isPop3Protocol()) {
				$msgNoToUIDL = $ieX->getPop3NewMessagesToDownloadForCron();
				// get all the keys which are msgnos;
				$newMsgs = array_keys($msgNoToUIDL);
			}
			if($ieX->connectMailserver() == 'true') {
				$connectToMailServer = true;
			} // if

			$GLOBALS['log']->debug('Trying to connect to mailserver for [ '.$a['name'].' ]');
			if($connectToMailServer) {
				$GLOBALS['log']->debug('Connected to mailserver');
				if (!$ieX->isPop3Protocol()) {
					$newMsgs = $ieX->getNewMessageIds();
				}
				if(is_array($newMsgs)) {
					$current = 1;
					$total = count($newMsgs);
					$dotbFolder = new DotbFolder();
					$groupFolderId = $ieX->groupfolder_id;
					$isGroupFolderExists = false;
					$users = array();
					if ($groupFolderId != null && $groupFolderId != "") {
						$dotbFolder->retrieve($groupFolderId);
						$isGroupFolderExists = true;
						$_REQUEST['team_id'] = $dotbFolder->team_id;
						$_REQUEST['team_set_id'] = $dotbFolder->team_set_id;
                        $_REQUEST['acl_team_set_id'] = $dotbFolder->acl_team_set_id;
					} // if
					$messagesToDelete = array();
					if ($ieX->isMailBoxTypeCreateCase()) {
						$users[] = $dotbFolder->assign_to_id;
						$GLOBALS['log']->debug('Getting users for teamset');
						$teamSet = BeanFactory::newBean('TeamSets');
						$usersList = $teamSet->getTeamSetUsers($dotbFolder->team_set_id, true);
						$GLOBALS['log']->debug('Done Getting users for teamset');
						$users = array();
						foreach($usersList as $userObject) {
							if ($userObject->is_group) {
								continue;
							} // if
							$users[] = $userObject->id;
						} // foreach
						$distributionMethod = $ieX->get_stored_options("distrib_method", "");
						if ($distributionMethod != 'roundRobin') {
							$counts = $emailUI->getAssignedEmailsCountForUsers($users);
						} else {
							$lastRobin = $emailUI->getLastRobin($ieX);
						}
						$GLOBALS['log']->debug('distribution method id [ '.$distributionMethod.' ]');
					}
					foreach($newMsgs as $k => $msgNo) {
						$uid = $msgNo;
						if ($ieX->isPop3Protocol()) {
							$uid = $msgNoToUIDL[$msgNo];
						} else {
							$uid = imap_uid($ieX->conn, $msgNo);
						} // else
						if ($isGroupFolderExists) {
							$_REQUEST['team_id'] = $dotbFolder->team_id;
							$_REQUEST['team_set_id'] = $dotbFolder->team_set_id;
                            $_REQUEST['acl_team_set_id'] = $dotbFolder->acl_team_set_id;
							if ($ieX->importOneEmail($msgNo, $uid)) {
								// add to folder
								$dotbFolder->addBean($ieX->email);
								if ($ieX->isPop3Protocol()) {
									$messagesToDelete[] = $msgNo;
								} else {
									$messagesToDelete[] = $uid;
								}
								if ($ieX->isMailBoxTypeCreateCase()) {
									$userId = "";
									if ($distributionMethod == 'roundRobin') {
										if (sizeof($users) == 1) {
											$userId = $users[0];
											$lastRobin = $users[0];
										} else {
											$userIdsKeys = array_flip($users); // now keys are values
											$thisRobinKey = $userIdsKeys[$lastRobin] + 1;
											if(!empty($users[$thisRobinKey])) {
												$userId = $users[$thisRobinKey];
												$lastRobin = $users[$thisRobinKey];
											} else {
												$userId = $users[0];
												$lastRobin = $users[0];
											}
										} // else
									} else {
										if (sizeof($users) == 1) {
											foreach($users as $k => $value) {
												$userId = $value;
											} // foreach
										} else {
											asort($counts); // lowest to highest
											$countsKeys = array_flip($counts); // keys now the 'count of items'
											$leastBusy = array_shift($countsKeys); // user id of lowest item count
											$userId = $leastBusy;
											$counts[$leastBusy] = $counts[$leastBusy] + 1;
										}
									} // else
									$GLOBALS['log']->debug('userId [ '.$userId.' ]');
									$ieX->handleCreateCase($ieX->email, $userId);
								} // if
							} // if
						} else {
								if($ieX->isAutoImport()) {
									$ieX->importOneEmail($msgNo, $uid);
								} else {
									/*If the group folder doesn't exist then download only those messages
									 which has caseid in message*/
									$ieX->getMessagesInEmailCache($msgNo, $uid);
									$email = BeanFactory::newBean('Emails');
									$header = imap_headerinfo($ieX->conn, $msgNo);
									$email->name = $ieX->handleMimeHeaderDecode($header->subject);
									$email->from_addr = $ieX->convertImapToDotbEmailAddress($header->from);
									$email->reply_to_email  = $ieX->convertImapToDotbEmailAddress($header->reply_to);
									if(!empty($email->reply_to_email)) {
										$contactAddr = $email->reply_to_email;
									} else {
										$contactAddr = $email->from_addr;
									}
									$mailBoxType = $ieX->mailbox_type;
									if (($mailBoxType == 'support') || ($mailBoxType == 'pick')) {
										if(!class_exists('aCase')) {

										}
										$c = BeanFactory::newBean('Cases');
										$GLOBALS['log']->debug('looking for a case for '.$email->name);
										if ($ieX->getCaseIdFromCaseNumber($email->name, $c)) {
											$ieX->importOneEmail($msgNo, $uid);
										} else {
											$ieX->handleAutoresponse($email, $contactAddr);
										} // else
									} else {
										$ieX->handleAutoresponse($email, $contactAddr);
									} // else
								} // else
						} // else
						$GLOBALS['log']->debug('***** On message [ '.$current.' of '.$total.' ] *****');
						$current++;
					} // foreach
					// update Inbound Account with last robin
					if ($ieX->isMailBoxTypeCreateCase() && $distributionMethod == 'roundRobin') {
						$emailUI->setLastRobin($ieX, $lastRobin);
					} // if

				} // if
				if ($isGroupFolderExists)	 {
					$leaveMessagesOnMailServer = $ieX->get_stored_options("leaveMessagesOnMailServer", 0);
					if (!$leaveMessagesOnMailServer) {
						if ($ieX->isPop3Protocol()) {
							$ieX->deleteMessageOnMailServerForPop3(implode(",", $messagesToDelete));
						} else {
							$ieX->deleteMessageOnMailServer(implode($app_strings['LBL_EMAIL_DELIMITER'], $messagesToDelete));
						}
					}
				}
			} else {
				$GLOBALS['log']->fatal("SCHEDULERS: could not get an IMAP connection resource for ID [ {$a['id']} ]. Skipping mailbox [ {$a['name']} ].");
				// cn: bug 9171 - continue while
			} // else
		} // foreach
		imap_expunge($ieX->conn);
		imap_close($ieX->conn, CL_EXPUNGE);
	} // while
    $GLOBALS['current_user']->team_id = $_bck_up['team_id'];
    $GLOBALS['current_user']->team_set_id = $_bck_up['team_set_id'];
	return true;
}

/**
 * Job 2
 */
function runMassEmailCampaign() {
	if (!class_exists('LoggerManager')){

	}
	$GLOBALS['log'] = LoggerManager::getLogger('emailmandelivery');
	$GLOBALS['log']->debug('Called:runMassEmailCampaign');

	if (!class_exists('DBManagerFactory')){
		require('include/database/DBManagerFactory.php');
	}

	global $beanList;
	global $beanFiles;
	require("config.php");
	require('include/modules.php');
	if(!class_exists('AclController')) {
		require('modules/ACL/ACLController.php');
	}

	require('modules/EmailMan/EmailManDelivery.php');
	return true;
}

/**
 *  Job 3
 */
function pruneDatabase() {
	$GLOBALS['log']->info('----->Scheduler fired job of type pruneDatabase()');

	$db = DBManagerFactory::getInstance();
	$tables = $db->getTablesArray();

	if(!empty($tables)) {
        foreach ($tables as $table) {
			// find tables with deleted=1
			$columns = $db->get_columns($table);
			// no deleted - won't delete
			if(empty($columns['deleted'])) continue;

            if (in_array($table . '_cstm', $tables)) {
			    $custom_columns = $db->get_columns($table.'_cstm');
                if (!empty($custom_columns['id_c'])) {
                    $db->query('DELETE FROM ' . $table . '_cstm WHERE id_c IN'
                        . ' (SELECT id FROM ' . $table . ' WHERE deleted = 1)');
			    }
			}

			// now do the actual delete
			$db->query('DELETE FROM '.$table.' WHERE deleted = 1');
		} // foreach() tables

		return true;
	}
	return false;
}


///**
// * Job 4
// */

function trimTracker()
{
    global $dotb_config, $timedate;
	$GLOBALS['log']->info('----->Scheduler fired job of type trimTracker()');
	$db = DBManagerFactory::getInstance();

	$admin = Administration::getSettings('tracker');
	require('modules/Trackers/config.php');
	$trackerConfig = $tracker_config;

    require_once('include/utils/db_utils.php');
    $prune_interval = !empty($admin->settings['tracker_prune_interval']) ? $admin->settings['tracker_prune_interval'] : 30;
	foreach($trackerConfig as $tableName=>$tableConfig) {

		//Skip if table does not exist
		if(!$db->tableExists($tableName)) {
		   continue;
		}

	    $timeStamp = db_convert("'". $timedate->asDb($timedate->getNow()->get("-".$prune_interval." days")) ."'" ,"datetime");
		if($tableName == 'tracker_sessions') {
		   $query = "DELETE FROM $tableName WHERE date_end < $timeStamp";
		} else {
		   $query = "DELETE FROM $tableName WHERE date_modified < $timeStamp";
		}

	    $GLOBALS['log']->info("----->Scheduler is about to trim the $tableName table by running the query $query");
		$db->query($query);
	} //foreach
    return true;
}

/* Job 5
 *
 */
function pollMonitoredInboxesForBouncedCampaignEmails() {
	$GLOBALS['log']->info('----->Scheduler job of type pollMonitoredInboxesForBouncedCampaignEmails()');
	global $dictionary;


	$ie = BeanFactory::newBean('InboundEmail');
	$r = $ie->db->query('SELECT id FROM inbound_email WHERE deleted=0 AND status=\'Active\' AND mailbox_type=\'bounce\'');

	while($a = $ie->db->fetchByAssoc($r)) {
		$ieX = BeanFactory::getBean('InboundEmail', $a['id'], array('disable_row_level_security' => true));
		$ieX->connectMailserver();
        $GLOBALS['log']->info("Bounced campaign scheduler connected to mail server id: {$a['id']} ");
		$newMsgs = array();
		if ($ieX->isPop3Protocol()) {
			$newMsgs = $ieX->getPop3NewMessagesToDownload();
		} else {
			$newMsgs = $ieX->getNewMessageIds();
		}

		//$newMsgs = $ieX->getNewMessageIds();
		if(is_array($newMsgs)) {
			foreach($newMsgs as $k => $msgNo) {
				$uid = $msgNo;
				if ($ieX->isPop3Protocol()) {
					$uid = $ieX->getUIDLForMessage($msgNo);
				} else {
					$uid = imap_uid($ieX->conn, $msgNo);
				} // else
                 $GLOBALS['log']->info("Bounced campaign scheduler will import message no: $msgNo");
				$ieX->importOneEmail($msgNo, $uid, false,false);
			}
		}
		imap_expunge($ieX->conn);
		imap_close($ieX->conn);
	}

	return true;
}

/**
 * Job 6
 */
function processWorkflow() {
	include_once('process_workflow.php');
	return true;
}

/**
 * Job 7
 */
function processQueue() {
    include_once('process_queue.php');
    return true;
}


/**
 * Job 9
 */
function updateTrackerSessions() {
    global $dotb_config, $timedate;
	$GLOBALS['log']->info('----->Scheduler fired job of type updateTrackerSessions()');
	$db = DBManagerFactory::getInstance();
    require_once('include/utils/db_utils.php');
	//Update tracker_sessions to set active flag to false
	$sessionTimeout = db_convert("'".$timedate->getNow()->get("-6 hours")->asDb()."'" ,"datetime");
	$query = "UPDATE tracker_sessions set active = 0 where date_end < $sessionTimeout";
	$GLOBALS['log']->info("----->Scheduler is about to update tracker_sessions table by running the query $query");
	$db->query($query);
	return true;
}

/**
 * Job 12
 */
function sendEmailReminders()
{
    $GLOBALS['log']->info('----->Scheduler fired job of type sendEmailReminders()');
    sendAppReminders();
    $reminder = new EmailReminder();
    return $reminder->process();
}

/**
 * Job 20
 */
function cleanOldRecordLists() {
    global $timedate;

	$GLOBALS['log']->info('----->Scheduler fired job of type cleanOldRecordLists()');
    $delTime = time()-3600; // Nuke anything an hour old. 

    $hourAgo = $timedate->asDb($timedate->getNow()->modify("-1 hour"));
    
    $db = DBManagerFactory::getInstance();
    
    $query = "DELETE FROM record_list WHERE date_modified < '".$db->quote($hourAgo)."'";
    $db->query($query,true);

	return true;
}



function cleanJobQueue($job)
{
    $td = TimeDate::getInstance();
    // soft delete all jobs that are older than cutoff
    $soft_cutoff = 7;
    if(isset($GLOBALS['dotb_config']['jobs']['soft_lifetime'])) {
        $soft_cutoff = $GLOBALS['dotb_config']['jobs']['soft_lifetime'];
    }
    $soft_cutoff_date = $job->db->quoted($td->getNow()->modify("- $soft_cutoff days")->asDb());
    $job->db->query("UPDATE {$job->table_name} SET deleted=1 WHERE status='done' AND date_modified < ".$job->db->convert($soft_cutoff_date, 'datetime'));
    // hard delete all jobs that are older than hard cutoff
    $hard_cutoff = 21;
    if(isset($GLOBALS['dotb_config']['jobs']['hard_lifetime'])) {
        $hard_cutoff = $GLOBALS['dotb_config']['jobs']['hard_lifetime'];
    }
    $hard_cutoff_date = $job->db->quoted($td->getNow()->modify("- $hard_cutoff days")->asDb());
    $job->db->query("DELETE FROM {$job->table_name} WHERE status='done' AND date_modified < ".$job->db->convert($hard_cutoff_date, 'datetime'));
    return true;
}

if (DotbAutoLoader::existing('custom/modules/Schedulers/_AddJobsHere.php')) {
	require('custom/modules/Schedulers/_AddJobsHere.php');
}

$extfile = DotbAutoLoader::loadExtension('schedulers');
if($extfile) {
    require $extfile;
}

$extfile = DotbAutoLoader::loadExtension('app_schedulers');
if($extfile) {
    require $extfile;
}

function sendAppReminders(){
    require_once("custom/clients/mobile/helper/NotificationHelper.php");
    global $timedate, $db;
    $notify = new NotificationMobile();
    $max_time = 0;
    if (isset($GLOBALS['app_list_strings']['reminder_time_options'])) {
        foreach ($GLOBALS['app_list_strings']['reminder_time_options'] as $seconds => $value) {
            if ($seconds > $max_time) {
                $max_time = $seconds;
            }
        }
    } else {
        $max_time = 8400;
    }
    $now = $timedate->nowDb();
    $max = $timedate->getNow()->modify("+{$max_time} seconds")->asDb();

    $q1 = "
            SELECT IFNULL(id, '') id,
			IFNULL(date_start, '') date_start,
			IFNULL(description, '') description,
            IFNULL(name, '') AS name,
            IFNULL(remind_popup, '') remind_popup,
            IFNULL(assigned_user_id, '') assigned_user_id
			FROM tasks
            WHERE app_reminder_sent = 0
            AND remind_popup <> '-1'
            AND date_start >= '{$now}'
            AND date_start <= '{$max}'
        ";

    $re1 = $db->query($q1);
    while ($row = $db->fetchByAssoc($re1)) {
        $remind_ts = $timedate->fromDb($db->fromConvert($row['date_start'], 'datetime'))->modify("-{$row['remind_popup']} seconds")->ts;
        $now_ts = $timedate->getNow()->ts;
        if ($now_ts >= $remind_ts) {
            $q1_1 = "UPDATE tasks SET app_reminder_sent = 1 WHERE id = '" . $row['id'] . "'";
            $GLOBALS['db']->query($q1_1);
            //Push notification
            $notify->pushNotification("Tasks: " . $row['name'], $row['description'], "Tasks", $row['id'], $row['assigned_user_id'], "reminder", $row['name'], $row['remind_popup']);
        }
    }

    $q2 = "
            SELECT IFNULL(id, '') id,
            IFNULL(date_start, '') date_start,
			IFNULL(description, '') description,
            IFNULL(name, '') AS name,
            IFNULL(reminder_time, '') reminder_time,
            IFNULL(assigned_user_id, '') assigned_user_id
			FROM calls
            WHERE app_reminder_sent = 0
            AND deleted = 0
            AND reminder_time <> '-1'
            AND date_start >= '{$now}'
            AND date_start <= '{$max}'
        ";

    $re2 = $db->query($q2);
    while ($row = $db->fetchByAssoc($re2)) {
        $remind_ts = $timedate->fromDb($db->fromConvert($row['date_start'], 'datetime'))->modify("-{$row['reminder_time']} seconds")->ts;
        $now_ts = $timedate->getNow()->ts;
        if ($now_ts >= $remind_ts) {
            $q1_1 = "UPDATE calls SET app_reminder_sent = 1 WHERE id = '" . $row['id'] . "'";
            $GLOBALS['db']->query($q1_1);
            //Push notification
            $notify->pushNotification("Calls: " . $row['name'], $row['description'], "Calls", $row['id'], $row['assigned_user_id'], "reminder", $row['name'], $row['reminder_time']);
        }
    }

    $q3 = "
            SELECT IFNULL(id, '') id,
            IFNULL(date_start, '') date_start,
			IFNULL(description, '') description,
            IFNULL(name, '') AS name,
            IFNULL(reminder_time, '') reminder_time,
            IFNULL(assigned_user_id, '') assigned_user_id
			FROM meetings 
            WHERE app_reminder_sent = 0
            AND deleted = 0
            AND reminder_time <> '-1'
            AND date_start >= '{$now}'
            AND date_start <= '{$max}'
        ";

    $re3 = $db->query($q3);
    while ($row = $db->fetchByAssoc($re3)) {
        $remind_ts = $timedate->fromDb($db->fromConvert($row['date_start'], 'datetime'))->modify("-{$row['reminder_time']} seconds")->ts;
        $now_ts = $timedate->getNow()->ts;
        if ($now_ts >= $remind_ts) {
            $q1_1 = "UPDATE meetings SET app_reminder_sent = 1 WHERE id = '" . $row['id'] . "'";
            $GLOBALS['db']->query($q1_1);
            //Push notification
            $notify->pushNotification("Meetings: " . $row['name'], $row['description'], "Meetings", $row['id'], $row['assigned_user_id'], "reminder", $row['name'], $row['reminder_time']);
        }
    }



    return true;
}
