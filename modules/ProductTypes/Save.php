<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/

use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;




$focus = BeanFactory::getBean('ProductTypes', $_REQUEST['record']);

	foreach($focus->column_fields as $field)
	{
		if(isset($_REQUEST[$field]))
		{
			$focus->$field = InputValidation::getService()->getValidInputRequest($field);
			
		}
	}
	
	foreach($focus->additional_column_fields as $field)
	{
		if(isset($_REQUEST[$field]))
		{
			$focus->$field = InputValidation::getService()->getValidInputRequest($field);
			
		}
	}



$focus->save();
$return_id = $focus->id;

$edit='';
if(isset($_REQUEST['return_module']) && $_REQUEST['return_module'] != "") $return_module = $_REQUEST['return_module'];
else $return_module = "ProductTypes";
if(isset($_REQUEST['return_action']) && $_REQUEST['return_action'] != "") $return_action = $_REQUEST['return_action'];
else $return_action = "DetailView";
if(isset($_REQUEST['return_id']) && $_REQUEST['return_id'] != "") $return_id = $_REQUEST['return_id'];
if(!empty($_REQUEST['edit'])) {
	$return_id='';
	$edit='&edit=true';
}

$GLOBALS['log']->debug("Saved record with id of ".$return_id);

header("Location: index.php?action=$return_action&module=$return_module&record=$return_id$edit");
?>