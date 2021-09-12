<?php

require_once('modules/Campaigns/utils.php');

$GLOBALS['log']->debug('identifier from the image request is'.$_REQUEST['identifier']);
if(!empty($_REQUEST['identifier'])) {
	$keys=log_campaign_activity($_REQUEST['identifier'],'viewed');
}
dotb_cleanup();
Header("Content-Type: image/gif");
$fn=dotb_fopen(DotbThemeRegistry::current()->getImageURL("blank.gif",false),"r");
fpassthru($fn);
?>
