<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/






$focus = BeanFactory::getBean('WorkFlowAlertShells', $_POST['record']);


foreach($focus->column_fields as $field)
{
	if(isset($_POST[$field]))
	{
		$focus->$field = $_POST[$field];
		
	}
}

foreach($focus->additional_column_fields as $field)
{
	if(isset($_POST[$field]))
	{
		$value = $_POST[$field];
		$focus->$field = $value;
		
	}
}

if($focus->custom_template_id!=""){
	$focus->alert_text="";
}	

$focus->save();

//Rewrite the workflow files
$workflow_object = $focus->get_workflow_object();
$workflow_object->write_workflow();


$return_id = $focus->id;

if(isset($_POST['return_module']) && $_POST['return_module'] != "") $return_module = $_POST['return_module'];
else $return_module = "WorkFlowAlertShells";
if(isset($_POST['return_action']) && $_POST['return_action'] != "") $return_action = $_POST['return_action'];
else $return_action = "DetailView";

$GLOBALS['log']->debug("Saved record with id of ".$return_id);

header("Location: index.php?action=DetailView&module=WorkFlowAlertShells&module_tab=WorkFlow&record=$return_id&workflow_id=$focus->parent_id");
?>
