<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/





$workflow = BeanFactory::newBean('WorkFlow');
if(isset($_REQUEST['workflow_id']) && isset($_REQUEST['record_id']))
{
	$alert_shell = BeanFactory::getBean('WorkFlowAlertShells', $_REQUEST['record_id']);
	$alert_shell->copy($_REQUEST['workflow_id']);
	
	$javascript = "<script>window.opener.document.DetailView.action.value = 'DetailView';";
	$javascript .= "window.opener.document.DetailView.submit();";
	$javascript .= "window.close();</script>";
	echo $javascript;
}
?>
