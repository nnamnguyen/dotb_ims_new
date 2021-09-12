<?php

if(!empty($_REQUEST['workflow_id']) && !empty($_REQUEST['record_id']))
{
    $action_shell = BeanFactory::getBean('WorkFlowActionShells', $_REQUEST['record_id']);
	$new_action_shell = $action_shell;
	$new_action_shell->id = "";
	$new_action_shell->parent_id = $_REQUEST['workflow_id'];
	$new_action_shell->save();
	$new_id = $new_action_shell->id;

	//process actions
	$action_shell->retrieve($_REQUEST['record_id']);
	$action_shell->copy($new_id);

    $workflow = BeanFactory::getBean('WorkFlow', $_REQUEST['workflow_id']);
	$workflow->write_workflow();

	$javascript = "<script>window.opener.document.DetailView.action.value = 'DetailView';";
	$javascript .= "window.opener.document.DetailView.submit();";
	$javascript .= "window.close();</script>";
	echo $javascript;
}
?>
