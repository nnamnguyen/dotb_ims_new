<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings;
$module_menu = Array(
	Array("index.php?module=MailMerge&action=index&reset=true", $mod_strings['LNK_NEW_MAILMERGE'],"MailMerge"),
	Array("index.php?module=Documents&action=EditView&return_module=MailMerge&return_action=EditView", $mod_strings['LNK_UPLOAD_TEMPLATE'],"MailMerge"),
	);
?>