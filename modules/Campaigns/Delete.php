<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

if(!isset($_REQUEST['record']))
{
	dotb_die("A record number must be specified to delete the campaign.");
}

$focus = BeanFactory::getBean('Campaigns', $_REQUEST['record']);

if (isset($_REQUEST['mode']) and $_REQUEST['mode']=='Test') {
	//deletes all data associated with the test run.
    $deleteTest = new DeleteTestCampaigns();
    $deleteTest->deleteTestRecords($focus);
} else {
	if(!$focus->ACLAccess('Delete')){
		ACLController::displayNoAccess(true);
		dotb_cleanup(true);
	}
	$focus->mark_deleted($_REQUEST['record']);
}

$return_id=!empty($_REQUEST['return_id'])?$_REQUEST['return_id']:$focus->id;
require_once ('include/formbase.php');
handleRedirect($return_id, $_REQUEST['return_module']);