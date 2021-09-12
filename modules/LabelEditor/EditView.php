<?php

$style='embeded';
if(isset($_REQUEST['style'])){
	$style = $_REQUEST['style'];	
}
if(isset($_REQUEST['module_name'])){
	$the_strings = return_module_language($current_language, $_REQUEST['module_name']);
	
	

	global $app_strings;
	global $app_list_strings;
	global $mod_strings;
	global $current_user;
	
    echo DotbThemeRegistry::current()->getCSS();
	echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME'],$_REQUEST['module_name']), true);
	
		





	$xtpl=new XTemplate ('modules/LabelEditor/EditView.html');
	$xtpl->assign("MOD", $mod_strings);
	$xtpl->assign("APP", $app_strings);
	$xtpl->assign("MODULE_NAME", $_REQUEST['module_name']);
	$xtpl->assign("STYLE",$style);
	if(isset($_REQUEST['dotb_body_only'])){
		$xtpl->assign("DOTB_BODY_ONLY",$_REQUEST['dotb_body_only']);
	}
	
	if(isset($_REQUEST['record']) ){
		$xtpl->assign("NO_EDIT", "readonly");
		$xtpl->assign("KEY", $_REQUEST['record']);
		if(isset($the_strings[$_REQUEST['record']])){
			$xtpl->assign("VALUE",$the_strings[$_REQUEST['record']]);
		}else{
			if(isset($_REQUEST['value']) )$xtpl->assign("VALUE", $_REQUEST['value']);	
		}
	}
	if($style == 'popup'){
		$xtpl->parse("main.popup");
	}
	$xtpl->parse("main");
	$xtpl->out("main");

}
else{
	echo 'No Module Selected';
}	



?>