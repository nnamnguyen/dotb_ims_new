<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/


global $mod_strings;



$focus = BeanFactory::newBean('Products');

if(!isset($_REQUEST['record']))
	dotb_die($mod_strings['ERR_DELETE_RECORD']);
$focus->retrieve($_REQUEST['record']);
if(!$focus->ACLAccess('Delete')){
		ACLController::displayNoAccess(true);
		dotb_cleanup(true);
}
$focus->mark_deleted($_REQUEST['record']);

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
?>
