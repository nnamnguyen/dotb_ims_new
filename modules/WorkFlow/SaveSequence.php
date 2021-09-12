<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/




$local_log =& LoggerManager::getLogger('index');

$focus = BeanFactory::newBean('WorkFlow');
$controller = new Controller();

	
	//if we are saving from the adddatasetform
	$focus->retrieve($_REQUEST['workflow_id']);

		
		$magnitude = 1;
		$direction = $_REQUEST['direction'];

		$controller->init($focus, "Save");
		$controller->change_component_order($magnitude, $direction, $focus->base_module);

$focus->save();

$focus->write_workflow();
	
if(isset($_REQUEST['return_module']) && $_REQUEST['return_module'] != "") $return_module = $_REQUEST['return_module'];
else $return_module = "Workflow";
if(isset($_REQUEST['return_action']) && $_REQUEST['return_action'] != "") $return_action = $_REQUEST['return_action'];
else $return_action = "ProcessListView";

//echo "index.php?action=$return_action&module=$return_module&record=$return_id";

header("Location: index.php?action=$return_action&module=$return_module&base_module=".$_REQUEST['base_module']."");
?>
