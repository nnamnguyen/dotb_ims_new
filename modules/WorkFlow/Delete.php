<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/


global $mod_strings;



$focus = BeanFactory::newBean('WorkFlow');

if(!isset($_REQUEST['record']))
	dotb_die($mod_strings['ERR_DELETE_RECORD']);

	
	$focus->retrieve($_REQUEST['record']);
	
    $focus->mark_deleted($_REQUEST['record']);
	//Re-write workflow
	$focus->write_workflow();

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
?>
