<?php

/*********************************************************************************
 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/



$focus = BeanFactory::newBean('Holidays');

if(!isset($_REQUEST['record']))
	dotb_die("A record number must be specified to delete this holiday.");

$focus->mark_deleted($_REQUEST['record']);

// Bug 11485: Redirect to "My Account" page, do not expose Holiday listview
global $current_user;
header("Location: index.php?module=Users&action=DetailView&record=".$current_user->id);
?>
