<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/



global $mod_strings;

$focus = BeanFactory::newBean('EmailMarketing');

if(!isset($_REQUEST['record'])) {
	dotb_die($mod_strings['LBL_SPECIFY_RECORD_NUM']);
}
$focus->retrieve($_REQUEST['record']);
if(!$focus->ACLAccess('Delete')){
	ACLController::displayNoAccess(true);
	dotb_cleanup(true);
}
$focus->mark_deleted($_REQUEST['record']);

if(isset($_REQUEST['record']))
{
    $query = 'DELETE FROM emailman WHERE marketing_id = ' . $focus->db->quoted($_REQUEST['record']);
	$focus->db->query($query);
}

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
