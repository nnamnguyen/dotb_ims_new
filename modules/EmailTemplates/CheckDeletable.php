<?php

/*********************************************************************************
 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


$focus = BeanFactory::newBean('EmailTemplates');
if($_REQUEST['from'] == 'DetailView') {
	if(!isset($_REQUEST['record']))
		dotb_die("A record number must be specified to delete the template.");
	$focus->retrieve($_REQUEST['record']);
	if(check_email_template_in_use($focus)) {
		echo 'true';
		return;
	}
	echo 'false';
} else if($_REQUEST['from'] == 'ListView') {
	$returnString = '';
	$idArray = explode(',', $_REQUEST['records']);
	foreach($idArray as $key => $value) {
		if($focus->retrieve($value)) {
			if(check_email_template_in_use($focus)) {
				$returnString .= $focus->name . ',';
			}
		}
	}
	$returnString = substr($returnString, 0, -1);
	echo $returnString;
} else {
	echo '';
}

function check_email_template_in_use($focus)
{
	if($focus->is_used_by_email_marketing()) {
		return true;
	}
	$system = $GLOBALS['dotb_config']['passwordsetting'];
	if($focus->id == $system['generatepasswordtmpl'] || $focus->id == $system['lostpasswordtmpl']) {
	    return true;
	}
    return false;
}
