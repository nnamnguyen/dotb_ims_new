<?php

/*********************************************************************************
 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
require_once('include/formbase.php');






$focus = BeanFactory::getBean('ContractTypes', $_POST['record']);
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
$return_id=$focus->save($check_notify);
$GLOBALS['log']->debug("Saved record with id of ".$return_id);
$url = buildRedirectURL($return_id, 'ContractTypes');
if (isset($_REQUEST['edit'])) $url.="&edit=".$_REQUEST['edit'];
if (isset($_REQUEST['isDuplicate'])) $url.="&isDuplicate=".$_REQUEST['isDuplicate'];
DotbApplication::redirect($url);
