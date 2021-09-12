<?php



if(!ACLController::checkAccess('Calendar', 'list', true)){
	ACLController::displayNoAccess(true);
}


global $cal_strings, $current_language;
$cal_strings = return_module_language($current_language, 'Calendar');

if(empty($_REQUEST['view'])){
	$_REQUEST['view'] = DotbConfig::getInstance()->get('calendar.default_view','week');
}

$cal = new Calendar($_REQUEST['view']);

if(in_array($cal->view,array('day','week','month'))){
	$cal->add_activities($GLOBALS['current_user']);	
    $cal->load_activities();
}else if($cal->view == 'shared'){
	$cal->init_shared();	
	global $shared_user;				
	$shared_user = BeanFactory::newBean('Users');	
	foreach($cal->shared_ids as $member){
		$shared_user->retrieve($member);
        $cal->loadActivitiesForUser($shared_user);
	}
}

if (!empty($_REQUEST['print']) && $_REQUEST['print'] == 'true') {
    $cal->setPrint(true);
}

$display = new CalendarDisplay($cal);
$display->display_title();
if($cal->view == "shared")
	$display->display_shared_html();
$display->display_calendar_header();
$display->display();
$display->display_calendar_footer();	

?>
