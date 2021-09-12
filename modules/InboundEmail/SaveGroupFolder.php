<?php

/*********************************************************************************
 * Description:  Saves an Account record and then redirects the browser to the
 * defined return URL.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$folder = new DotbFolder();
$_REQUEST['name'] = $_REQUEST['groupFolderAddName'];
$_REQUEST['parent_folder'] = $_REQUEST['groupFoldersAdd'];
$_REQUEST['group_id'] = $_REQUEST['groupFoldersUser'];
$_REQUEST['team_id'] = $_REQUEST['primaryTeamId'];
$teamSet = BeanFactory::newBean('TeamSets');
$teamIds = explode(",", $_REQUEST['teamIds']);
$team_set_id = $teamSet->addTeams($teamIds);
$_REQUEST['team_set_id'] = $team_set_id;
if (empty($_REQUEST['record'])) {
	$folder->setFolder($_REQUEST);
} else {
	$folder->updateFolder($_REQUEST);
}
$body1 = "
	<script type='text/javascript'>
		function refreshOpener() {
			window.opener.refresh_group_folder_list('$folder->id','$folder->name')
			window.close();
		} // fn
		refreshOpener();
	</script>";
echo  $body1;
?>
