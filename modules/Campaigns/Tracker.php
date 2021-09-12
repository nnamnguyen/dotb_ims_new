<?php
require_once('modules/Campaigns/utils.php');

$GLOBALS['log'] = LoggerManager::getLogger('Campaign Tracker v2');

$db = DBManagerFactory::getInstance();

if(empty($_REQUEST['track'])) {
	$track = "";
} else {
	$track = $_REQUEST['track'];
}
if(!empty($_REQUEST['identifier'])) {
	$keys=log_campaign_activity($_REQUEST['identifier'],'link',true,$track);
    
} elseif (!in_array(getCampaignType($track), array('Email', 'NewsLetter')) ||
    hasSentCampaignEmail($track)) {
    // this has no identifier, pass in with id set to string 'BANNER'
    // don't log if it's email/newsletter campaign and campaign emails haven't been sent
    $keys = log_campaign_activity('BANNER', 'link', true, $track);
}

$track = $db->quote($track);

if(preg_match('/^[0-9A-Za-z\-]*$/', $track))
{
	$query = "SELECT tracker_url FROM campaign_trkrs WHERE id='$track'";
	$res = $db->query($query);

	$row = $db->fetchByAssoc($res,false);

	$redirect_URL = $row['tracker_url'];
	dotb_cleanup();
	header("Location: $redirect_URL");
}
else
{
	dotb_cleanup();
}
exit;
?>
