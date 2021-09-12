<?php

global $mod_strings;
$module_menu = array(
	array('index.php?module=Groups&action=ListView', $mod_strings['LNK_ALL_GROUPS'], 'Teams'),
	array('index.php?module=Groups&action=EditView&return_module=Groups&return_action=ListView', $mod_strings['LNK_NEW_GROUP'], 'CreateTeams'),
	//array('index.php?module=Groups&action=ListView', $mod_strings['LNK_CONVERT_USER'], 'CreateTeams'),
);

?>