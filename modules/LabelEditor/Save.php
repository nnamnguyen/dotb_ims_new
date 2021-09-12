<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

global $current_language;

$request = InputValidation::getService();
$module_name = $request->getValidInputRequest('module_name', 'Assert\Mvc\ModuleName');

//Since $current_language could be passed in from anywhere, we cannot use the input validation directly.
//Just use basename() to avoid the basic path traversal
$current_language = basename($current_language);

if(isset($_REQUEST['multi_edit'])){
	unset($_REQUEST['action']);
	unset($_REQUEST['module_name']);
	unset($_REQUEST['module']);
	$the_strings = return_module_language($current_language, $module_name);
	foreach($_REQUEST as $key=>$value){
		if(isset($the_strings[$key])){
			create_field_label($module_name, $current_language, $key, $value, true);
		}
	}
	$location = "index.php?action=LabelList&module=LabelEditor&refreshparent=1&dotb_body_only=1";
	header("Location:$location" );
}else{
	create_field_label($module_name, $current_language, $_REQUEST['record'], $_REQUEST['value'], true);
		$location = "index.php?action=". $_REQUEST['return_action']."&module=". $_REQUEST['return_module'];
	if(isset($_REQUEST['module_name'])){
		$location .= "&module_name=" . $_REQUEST['module_name'];
	}
	if(isset($_REQUEST['dotb_body_only'])){
		$location .= "&dotb_body_only=" . $_REQUEST['dotb_body_only'];
	}
	if(isset($_REQUEST['style']) && $_REQUEST['style'] == 'popup'){
		$location .= '&refreshparent=1';	
	}
	header("Location:$location" );
}
