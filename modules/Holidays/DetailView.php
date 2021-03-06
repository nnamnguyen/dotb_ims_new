<?php

/*********************************************************************************
 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/



require_once('modules/Holidays/Forms.php');

global $mod_strings;
global $app_strings;
global $app_list_strings;
global $current_user;

$focus = BeanFactory::newBean('Holidays');

$detailView = new DetailView();
$offset=0;
if (isset($_REQUEST['offset']) or isset($_REQUEST['record'])) {
	$result = $detailView->processDotbBean("HOLIDAY", $focus, $offset);
	if($result == null) {
	    dotb_die($app_strings['ERROR_NO_RECORD']);
	}
	$focus=$result;
} else {
	header("Location: index.php?module=Accounts&action=index");
}
echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME']), true);

$GLOBALS['log']->info("Holiday detail view");

$xtpl=new XTemplate ('modules/Holidays/DetailView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("GRIDLINE", $gridline);
$xtpl->assign("ID", $focus->id);
$xtpl->assign("RETURN_MODULE", "Holidays");
$xtpl->assign("RETURN_ACTION", "DetailView");
$xtpl->assign("ACTION", "EditView");

$xtpl->assign("NAME", $focus->holiday_date);
$xtpl->assign("DESCRIPTION", nl2br(url2html($focus->description)));

$detailView->processListNavigation($xtpl, "HOLIDAY", $offset);

$xtpl->parse("main");
$xtpl->out("main");

?>