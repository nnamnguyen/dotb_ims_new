<?php

/*********************************************************************************
 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/





global $app_strings;
global $mod_strings;

if (empty($_REQUEST['record'])) {
    header("Location: index.php?module=ContractTypes&action=index");
}

$focus = BeanFactory::getBean('ContractTypes', $_REQUEST['record']);

if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}

echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME'],$focus->name), true);



$GLOBALS['log']->info("contract Types detail view");

$xtpl=new XTemplate ('modules/ContractTypes/DetailView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);

if (isset($_REQUEST['return_module'])) {
	$xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
} else {
	$xtpl->assign("RETURN_MODULE", 'ContractTypes');
}
if (isset($_REQUEST['return_action'])) {
	$xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
} else {
	$xtpl->assign("RETURN_ACTION", 'DetailView');
}
if (isset($_REQUEST['return_id'])) {
	$xtpl->assign("RETURN_ID", $_REQUEST['return_id']);
} else {
	$xtpl->assign("RETURN_ID", $focus->id);
}
 
$xtpl->assign("GRIDLINE", $gridline);
$xtpl->assign("ID", $focus->id);

$xtpl->assign("NAME", $focus->name);
$xtpl->assign("LIST_ORDER", $focus->list_order);

$xtpl->parse("main");
$xtpl->out("main");

$subpanel = new SubPanelTiles($focus, 'ContractTypes');
echo $subpanel->display();
?>