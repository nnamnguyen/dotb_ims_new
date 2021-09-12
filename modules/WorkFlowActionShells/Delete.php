<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/


global $mod_strings;



$focus = BeanFactory::newBean('WorkFlowActionShells');

if(!isset($_REQUEST['record']))
	dotb_die($mod_strings['ERR_DELETE_RECORD']);

	$focus->retrieve($_REQUEST['record']);
	
	//check for bridged child (invites for meetings/calls
	$focus->check_for_child_bridge(true);
	
	//mark delete alertshell components
	mark_delete_components($focus->get_linked_beans('actions','WorkFlowAction'));
	mark_delete_components($focus->get_linked_beans('rel1_action_fil','Expression'));
	$focus->mark_deleted($_REQUEST['record']);

	$workflow_object = $focus->get_workflow_object();
	$workflow_object->write_workflow();

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
?>
