<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings;
$module_menu = Array(
	Array("index.php?module=Teams&action=EditView&return_module=Teams&return_action=DetailView", $mod_strings['LNK_NEW_TEAM'], "CreateTeams"),
	Array("index.php?module=Teams&action=index", $mod_strings['LNK_LIST_TEAM'], "Teams"),
	Array("index.php?module=TeamNotices&action=index", $mod_strings['LNK_LIST_TEAMNOTICE'], "Teams"),
	Array("index.php?module=TeamNotices&action=EditView", $mod_strings['LNK_NEW_TEAM_NOTICE'], "Teams")
);

?>