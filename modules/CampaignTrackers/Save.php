<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
require_once('include/formbase.php');

$focus = BeanFactory::getBean('CampaignTrackers', $_POST['record']);
if(!$focus->ACLAccess('Save')){
	ACLController::displayNoAccess(true);
	dotb_cleanup(true);
}

$check_notify = FALSE;
foreach($focus->column_fields as $field) {
	if(isset($_POST[$field])) {
		$value = $_POST[$field];
		$focus->$field = $value;
	}
}

foreach($focus->additional_column_fields as $field) {
	if(isset($_POST[$field])) {
		$value = $_POST[$field];
		$focus->$field = $value;

	}
}
//set check box states.
if (isset($_POST['is_optout']) && $_POST['is_optout'] =='on') {
	$focus->is_optout=1;
	$focus->tracker_url='index.php?entryPoint=removeme';
} else {
	$focus->is_optout=0;
}

$focus->save($check_notify);
$return_id = $focus->id;
$GLOBALS['log']->debug("Saved record with id of ".$return_id);
handleRedirect('', '');
?>