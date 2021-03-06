<?php


global $theme;
global $mod_strings;


/* start standard DetailView layout process */
$GLOBALS['log']->info("Groups DetailView");
$focus = BeanFactory::getBean('Groups', $_REQUEST['record']);
$detailView = new DetailView();
$offset=0;
if (isset($_REQUEST['offset']) or isset($_REQUEST['record'])) {
	$result = $detailView->processDotbBean("Group", $focus, $offset);
	if($result == null) {
	    dotb_die($app_strings['ERROR_NO_RECORD']);
	}
	$focus=$result;
} else {
	header("Location: index.php?module=Groups&action=index");
}

echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME'],$focus->user_name), true);

/* end standard DetailView layout process */


$xtpl = new XTemplate('modules/Groups/DetailView.html');
$xtpl->assign('MOD', $mod_strings);
$xtpl->assign('APP', $app_strings);
$xtpl->assign("CREATED_BY", $focus->created_by_name);
$xtpl->assign("MODIFIED_BY", $focus->modified_by_name);
$xtpl->assign("GRIDLINE", $gridline);
$xtpl->assign("ID", $focus->id);
$xtpl->assign('USER_NAME', $focus->user_name);

$xtpl->parse('main');
$xtpl->out('main');
?>