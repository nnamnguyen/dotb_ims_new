<?php



//Create User Teams
$globalteam = BeanFactory::getBean('Teams', '1');
if(isset($globalteam->name)){
    echo 'Global '.$mod_strings['LBL_UPGRADE_TEAM_EXISTS'].'<br>';
    if($globalteam->deleted) {
        $globalteam->mark_undeleted($globalteam->id);
    }
} else {
    $globalteam->create_team("Global", $mod_strings['LBL_GLOBAL_TEAM_DESC'], $globalteam->global_team);
}

$results = $GLOBALS['db']->query("SELECT id, user_name FROM users WHERE default_team != '' AND default_team IS NOT NULL
    AND user_name NOT IN (" . $GLOBALS['db']->quoted(DotbSNIP::SNIP_USER) . ", 'DotbCustomerSupportPortalUser')");

$team = BeanFactory::newBean('Teams');
$user = BeanFactory::newBean('Users');
while($row = $GLOBALS['db']->fetchByAssoc($results)) {
	$results2 = $GLOBALS['db']->query("SELECT id, name FROM teams WHERE associated_user_id = '" . $row['id'] . "'");
	$row2 = $GLOBALS['db']->fetchByAssoc($results2);
	if(empty($row2['id'])) {
		$user->retrieve($row['id']);
		$team->new_user_created($user);
		// BUG 10339: do not display messages for upgrade wizard
		if(!isset($_REQUEST['upgradeWizard'])){
			echo $mod_strings['LBL_UPGRADE_TEAM_CREATE'].' '. $row['user_name']. '<br>';
		}
	}else{
		echo $row2['name'] .' '.$mod_strings['LBL_UPGRADE_TEAM_EXISTS'].'<br>';
	}

	$globalteam->add_user_to_team($row['id']);
}

echo '<br>' . $mod_strings['LBL_DONE'];
