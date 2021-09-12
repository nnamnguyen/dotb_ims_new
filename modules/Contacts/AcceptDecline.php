<?php

require_once 'include/utils.php';

global $dotb_config, $dbconfig, $beanList, $beanFiles, $app_strings, $app_list_strings, $current_user;

global $currentModule, $focus;

if ( !empty($_REQUEST['user_id'])) {
    $result = BeanFactory::retrieveBean('Users', $_REQUEST['user_id']);
    if (empty($result)) {
        session_destroy();
        dotb_cleanup();
        die("The user id doesn't exist");
    }
    $current_entity = $current_user = $result;
}
else if ( ! empty($_REQUEST['contact_id'])) {
    $result = BeanFactory::retrieveBean('Contacts', $_REQUEST['contact_id'], array('disable_row_level_security' => true));
    if(empty($result)) {
        session_destroy();
        dotb_cleanup();
        die("The contact id doesn't exist");
    }
    $current_entity = $result;
}
else if ( ! empty($_REQUEST['lead_id'])) {
    $result = BeanFactory::retrieveBean('Leads', $_REQUEST['lead_id'], array('disable_row_level_security' => true));
    if(empty($result)) {
        session_destroy();
        dotb_cleanup();
        die("The lead id doesn't exist");
    }
    $current_entity = $result;
}

$service = new CalendarEvents();
$focus = BeanFactory::retrieveBean(clean_string($_REQUEST['module']), $_REQUEST['record'], array('disable_row_level_security' => true));

if(empty($focus)) {
	session_destroy();
	dotb_cleanup();
	die("The focus id doesn't exist");
}

$updated = $service->updateAcceptStatusForInvitee(
    $focus,
    $current_entity,
    $_REQUEST['accept_status'],
    array('disable_row_level_security' => true)
);
$url  = $dotb_config['site_url'] . '#' . buildLumiaRoute($currentModule, $focus->id);

if ($updated) {
    print "{$app_strings['LBL_STATUS_UPDATED']}<br /><br />";
} else {
    print "{$app_strings['LBL_STATUS_NOT_UPDATED']}<br /><br />";
}

print $app_strings['LBL_STATUS']. " ". $app_list_strings['dom_meeting_accept_status'][$_REQUEST['accept_status']];
print "<BR><BR>";

if ($current_entity->module_name === 'Users') {
    print "<a href='{$url}'>" . $app_strings['LBL_MEETING_GO_BACK'] . "</a><br />";
}
dotb_cleanup();
exit;
