<?php

global $theme;
global $mod_strings;
global $app_list_strings;
global $current_user;

if (!$current_user->isAdminForModule("InboundEmail")) {
    dotb_die(translate('ERR_NOT_ADMIN'));
}

$focus = BeanFactory::newBean('InboundEmail');
$focus->checkImap();

///////////////////////////////////////////////////////////////////////////////
////	I-E SYSTEM SETTINGS
////	handle saving settings
if(isset($_REQUEST['save']) && $_REQUEST['save'] == 'true') {
	$focus->saveInboundEmailSystemSettings('Case', $_REQUEST['inbound_email_case_macro']);
}
////	END I-E SYSTEM SETTINGS
///////////////////////////////////////////////////////////////////////////////

if(is_admin($current_user) && $_REQUEST['module'] != 'DynamicLayout' && !empty($_SESSION['editinplace'])){	
	$ListView->setHeaderText("<a href='index.php?action=index&module=DynamicLayout&from_action=ListView&from_module=".$_REQUEST['module'] ."'>".DotbThemeRegistry::current()->getImage("EditLayout","border='0' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDIT_LAYOUT'])."</a>" );
}

$where = '';
$limit = '0';
$orderBy = 'date_entered';
$varName = $focus->object_name;
$allowByOverride = true;

$listView = new ListView();
$listView->initNewXTemplate('modules/InboundEmail/ListView.html', $mod_strings);
$listView->setHeaderTitle($mod_strings['LBL_MODULE_TITLE']);

echo $focus->getSystemSettingsForm();
$listView->show_export_button = false;
$listView->ignorePopulateOnly = TRUE; //Always show all records, ignore save_query performance setting.
$listView->setQuery($where, $limit, $orderBy, 'InboundEmail', $allowByOverride);
$listView->xTemplateAssign("EDIT_INLINE_IMG", DotbThemeRegistry::current()->getImage('edit_inline','align="absmiddle" border="0"', null,null,'.gif',$app_strings['LNK_EDIT']));
$listView->processListView($focus, "main", "InboundEmail");

