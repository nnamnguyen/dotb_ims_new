<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/


global $mod_strings;



$focus = BeanFactory::newBean('WorkFlowAlerts');

if(!isset($_REQUEST['record']))
	dotb_die($mod_strings['ERR_DELETE_RECORD']);

	
	$focus->retrieve($_REQUEST['record']);
	//mark delete alert expression components
	mark_delete_components($focus->get_linked_beans('expressions','Expression'));
	mark_delete_components($focus->get_linked_beans('rel1_alert_fil','Expression'));
	mark_delete_components($focus->get_linked_beans('rel2_alert_fil','Expression'));
	$focus->mark_deleted($_REQUEST['record']);

	$workflow_object = $focus->get_workflow_object();
	$workflow_object->write_workflow();
	
	
header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']."&workflow_id=".$_REQUEST['workflow_id']);
?>
