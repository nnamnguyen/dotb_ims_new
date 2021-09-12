<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
if (!$GLOBALS['current_user']->isAdminForModule('Users')) dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);

$focus = BeanFactory::newBean('TeamNotices');

require_once('include/formbase.php');
$focus = populateFromPost('', $focus);	

$focus->save();
$return_id = $focus->id;

handleRedirect('', 'TeamNotices');
?>