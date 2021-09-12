<?php


if(!empty($_REQUEST['grabbed'])) {
	
	$focus = BeanFactory::newBean('Emails');
	
	$emailIds = array();
	// CHECKED ONLY:
	$grabEx = explode('::',$_REQUEST['grabbed']);
	
	foreach($grabEx as $k => $emailId) {
		if($emailId != "undefined") {
			$focus->mark_deleted($emailId);
		}
	}
	
	header('Location: index.php?module=Emails&action=ListViewGroup');
} else {
	global $mod_strings;
	// error
	$error = $mod_strings['LBL_MASS_DELETE_ERROR'];
	header('Location: index.php?module=Emails&action=ListViewGroup&error='.$error);
}

?>
