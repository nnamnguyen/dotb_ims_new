<?php

$_REQUEST['edit']='true';


// GLOBALS
global $mod_strings;
global $app_strings;
global $app_list_strings;
global $current_user;
global $dotb_config;

$ie = BeanFactory::newBean('InboundEmail');
$focus = new DotbFolder();
$javascript = new javascript();
/* Start standard EditView setup logic */

if(isset($_REQUEST['record'])) {
	$GLOBALS['log']->debug("In EditGroupFolder view, about to retrieve record: ".$_REQUEST['record']);
	$result = $focus->retrieve($_REQUEST['record']);
    if($result == null)
    {
    	dotb_die($app_strings['ERROR_NO_RECORD']);
    }
}

$GLOBALS['log']->info("DotbFolder Edit View");
/* End standard EditView setup logic */

// TEMPLATE ASSIGNMENTS
$smarty = new Dotb_Smarty();
// standard assigns
$smarty->assign('mod_strings', $mod_strings);
$smarty->assign('app_strings', $app_strings);
$smarty->assign('theme', $theme);
$smarty->assign('dotb_version', $dotb_version);
$smarty->assign('GRIDLINE', $gridline);
$smarty->assign('MODULE', 'InboundEmail');
$smarty->assign('RETURN_MODULE', 'InboundEmail');
$smarty->assign('RETURN_ID', $focus->id);
$smarty->assign('RETURN_ACTION', "");
$smarty->assign('ID', $focus->id);
// module specific

$ret = $focus->getFoldersForSettings($current_user);
$groupFolders = Array();
$groupFoldersOrig = array();
foreach($ret['groupFolders'] as $key => $value) {
	if(!empty($focus->id)) {
		if ($value['id'] == $focus->id) {
			continue;
		}
	} // if
	$groupFolders[$value['id']] = $value['name'];
	$groupFoldersOrig[] = $value['origName'];
} // foreach
$groupFolderName = "";
$addToGroupFolder = "";
$createGroupFolderStyle = "display:''";
$editGroupFolderStyle = "display:''";
if(!empty($focus->id)) {
	$groupFolderName = 	$focus->name;
}
if(!empty($focus->id)) {
	$addToGroupFolder = $focus->parent_folder;
}
if(!empty($focus->id)) {
	$createGroupFolderStyle = "display:none;";
} else {
	$editGroupFolderStyle = "display:none;";
} // else
$smarty->assign('createGroupFolderStyle', $createGroupFolderStyle);
$smarty->assign('editGroupFolderStyle', $editGroupFolderStyle);

$smarty->assign('groupFolderName', $groupFolderName);
$json = getJSONobj();
$smarty->assign('group_folder_array', $json->encode($groupFoldersOrig));
$smarty->assign('group_folder_options', get_select_options_with_id($groupFolders, $addToGroupFolder));

$groupFolderTeamId = "";
if(!empty($focus->id)) {
	$groupFolderTeamId = $focus->team_id;
}


$teamSetField = new EmailDotbFieldTeamsetCollection($focus, $ie->field_defs, "get_non_private_teams_array");
$code = $teamSetField->get_code();
$sqs_objects = $teamSetField->createQuickSearchCode(false);

$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects = ' . $json->encode($sqs_objects) . '</script>';
$smarty->assign('JAVASCRIPT', $quicksearch_js);
$smarty->assign("TEAM_SET_FIELD", $code);
$smarty->assign("langHeader", get_language_header());

$smarty->assign('CSS',DotbThemeRegistry::current()->getCSS());


$smarty->assign('languageStrings', getVersionedScript("cache/jsLanguage/{$GLOBALS['current_language']}.js",  $GLOBALS['dotb_config']['js_lang_version']));
echo $smarty->fetch("modules/Emails/templates/_createGroupFolder.tpl");
