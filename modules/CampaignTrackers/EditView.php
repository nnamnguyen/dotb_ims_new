<?php

/*********************************************************************************

 * Description: TODO:  To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/




require_once('modules/CampaignTrackers/Forms.php');
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $dotb_version, $dotb_config;

$focus = BeanFactory::newBean('CampaignTrackers');

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}
$old_id = '';

if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}




$GLOBALS['log']->info("Campaign Tracker Edit View");

$xtpl=new XTemplate ('modules/CampaignTrackers/EditView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);

$campaignName = '';
$campaignId = '';
if (!empty($_REQUEST['campaign_name'])) {
	$xtpl->assign("CAMPAIGN_NAME", $_REQUEST['campaign_name']);
	$campaignName = $_REQUEST['campaign_name'];
} else {
	$xtpl->assign("CAMPAIGN_NAME", $focus->campaign_name);
	$campaignName = $focus->campaign_name;
}
if (!empty($_REQUEST['campaign_id'])) {
	$xtpl->assign("CAMPAIGN_ID", $_REQUEST['campaign_id']);
	$campaignId = $_REQUEST['campaign_id'];
} else {
	$xtpl->assign("CAMPAIGN_ID", $focus->campaign_id);
	$campaignId = $focus->campaign_id;
}
$params = array();
$params[] = "<a href='index.php?module=Campaigns&action=DetailView&record={$campaignId}'>{$campaignName}</a>";
$params[] = $mod_strings['LBL_MODULE_NAME'];
echo getClassicModuleTitle($focus->module_dir, $params, true);

if (isset($_REQUEST['return_module'])) $xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
if (isset($_REQUEST['return_action'])) $xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
if (isset($_REQUEST['return_id'])) $xtpl->assign("RETURN_ID", $_REQUEST['return_id']);

$xtpl->assign("JAVASCRIPT", get_set_focus_js().get_validate_record_js());
$xtpl->assign("ID", $focus->id);



$xtpl->assign("TRACKER_NAME", $focus->tracker_name);
$xtpl->assign("TRACKER_URL", $focus->tracker_url);

global $current_user;
if(is_admin($current_user) && $_REQUEST['module'] != 'DynamicLayout' && !empty($_SESSION['editinplace'])){	
	$record = '';
	if(!empty($_REQUEST['record'])){
		$record = 	$_REQUEST['record'];
	}
	$xtpl->assign("ADMIN_EDIT","<a href='index.php?action=index&module=DynamicLayout&from_action=".$_REQUEST['action'] ."&from_module=".$_REQUEST['module'] ."&record=".$record. "'>".DotbThemeRegistry::current()->getImage("EditLayout","border='0' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDIT_LAYOUT'])."</a>");
}
if (!empty($focus->is_optout) && $focus->is_optout == 1) {
	$xtpl->assign("IS_OPTOUT_CHECKED","checked");
	$xtpl->assign("TRACKER_URL_DISABLED","disabled");
}

$xtpl->parse("main");

$xtpl->out("main");

$javascript = new javascript();
$javascript->setFormName('EditView');
$javascript->setDotbBean($focus);
$javascript->addAllFields('');
echo $javascript->getScript();
?>