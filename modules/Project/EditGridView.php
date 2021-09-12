<?php



use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

/**
 * EditView for Project
 */

global $timedate;
global $app_strings;
global $app_list_strings;
global $current_language;
global $current_user;
global $hilite_bg;
global $dotb_version, $dotb_config;
$focus = BeanFactory::newBean('Project');

$request = InputValidation::getService();

if(!empty($_REQUEST['record']))
{
    $focus->retrieve($_REQUEST['record']);
}

$params = array();
$params[] = "<a href='index.php?module=Project&action=index'>{$mod_strings['LBL_MODULE_NAME']}</a>";
if ($focus->is_template)
	$params[] = "<a href='index.php?module=Project&action=ProjectTemplatesDetailView&record={$focus->id}'>{$focus->name}</a>";
else
    $params[] = "<a href='index.php?module=Project&action=DetailView&record={$focus->id}'>{$focus->name}</a>";

echo getClassicModuleTitle("Project", $params, true);

$GLOBALS['log']->info("Project detail view");

$dotb_smarty = new Dotb_Smarty();
///
/// Assign the template variables
///
$dotb_smarty->assign('MOD', $mod_strings);
$dotb_smarty->assign('APP', $app_strings);
$dotb_smarty->assign('name', $focus->name);
$dotb_smarty->assign("ID", $focus->id);
$dotb_smarty->assign("NAME", $focus->name);
$dotb_smarty->assign("IS_TEMPLATE", $focus->is_template);

$userBean = BeanFactory::newBean('Users');
$focus->load_relationship("user_resources");
$users = $focus->user_resources->getBeans($userBean);
$contactBean = BeanFactory::newBean('Contacts');
$focus->load_relationship("contact_resources");
$contacts = $focus->contact_resources->getBeans($contactBean);

$resources = array();
foreach ($users as $key => $user) {
    $resources[$user->full_name] = $user;
}
foreach ($contacts as $key => $contact) {
    $resources[$contact->full_name] = $contact;
}
ksort($resources);
$dotb_smarty->assign("RESOURCES", $resources);

// Get resource holidays ////////////////////////////////////////////////

$holidayBean = BeanFactory::newBean('Holidays');
$holidays = array();

if (count($resources) > 0){
	$query = "select * from holidays where (";
        $i = 0;
        $count = count($users);
        foreach ($users as $key => $user) {
            $query .= "person_id like '". $user->id . "'";
            if ($i < ($count - 1)) {
                $query .= " or ";
            }
            $i++;
        }

	if (count($users) > 0 && count($contacts) > 0)
	    $query .= " or ";

        $i = 0;
        $count = count($contacts);
        foreach ($contacts as $key => $contact) {
            $query .= "person_id like '". $contact->id . "'";
            if ($i < ($count - 1)) {
                $query .= " or ";
            }
            $i++;
        }
	$query .= " ) and deleted=0 and holiday_date between '". $timedate->to_db_date($focus->estimated_start_date, false) ."' and '". $timedate->to_db_date($focus->estimated_end_date, false) ."'";
	$result = $holidayBean->db->query($query, true, "");


	while (($row = $holidayBean->db->fetchByAssoc($result)) != null) {
	    $holiday = BeanFactory::retrieveBean('Holidays', $row['id']);
	    if(!empty($holiday)) {
	        array_push($holidays, $holiday);
	    }
	}
	$dotb_smarty->assign("HOLIDAYS", $holidays);
}
/////////////////////////////////////////////////////////////////////////

$dotb_smarty->assign("DURATION_UNITS", $app_list_strings['project_duration_units_dom']);
$dotb_smarty->assign("PROJECT", $focus);

$today = $timedate->nowDbDate();
$nextWeek = $timedate->asDbDate( $timedate->getNow()->get('+1 week'));


if (isset($_REQUEST["selected_view"]))
    $dotb_smarty->assign('SELECTED_VIEW', $request->getValidInputRequest('selected_view', array('Assert\Type' => array('type' => 'numeric'))));
else
    $dotb_smarty->assign("SELECTED_VIEW", 0);

if (isset($_REQUEST["view_filter_resource"]))
    $dotb_smarty->assign('VIEW_FILTER_RESOURCE', $request->getValidInputRequest('view_filter_resource'));



$projectTaskBean = BeanFactory::newBean('ProjectTask');
$projectTasks = array();

$queryPart = '';

// Start ACL check
global $current_user, $mod_strings;
if (!is_admin($current_user)) {
    $list_action = ACLAction::getUserAccessLevel($current_user->id, $projectTaskBean->module_dir, 'list', 'module');

    if ($list_action == ACL_ALLOW_NONE) {
        ACLController::displayNoAccess(true);
        return false;
    }

    $aclVisibility = new ACLVisibility($projectTaskBean);
    $aclVisibility->addVisibilityWhere($queryPart);
}
if (!empty($queryPart)) {
    $queryPart = 'AND ' . $queryPart;
}
// End ACL check

//todo: Ajay to make sure that the getBeans() call takes a sortArray and actually uses it.
//$focus->load_relationship("projecttask");
//$projectTasks = $focus->projecttask->getBeans($projectTaskBean);

// Completed Tasks
if (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 2) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) .
        " AND project_task.percent_complete='100' AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
    $result = $projectTaskBean->db->query($query, true, "");
}
//Incomplete Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 3) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) .
        " AND project_task.percent_complete < 100 AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
}
//Milestone Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 4) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) .
        " AND project_task.milestone_flag='1' AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
    $result = $projectTaskBean->db->query($query, true, "");
}
//Tasks for Resource
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 5) {
	$resource_name = explode(' ', $_REQUEST['view_filter_resource']);

	// check to see if a last name query is required
	if (!empty($resource_name[1])){
        $userLastNameQry = "AND users.last_name like " . $projectTaskBean->db->quoted($resource_name[1].'%') . " ";
        $contactLastNameQry = "AND contacts.last_name like " . $projectTaskBean->db->quoted($resource_name[1].'%') . " ";
	}
	else{
		$userLastNameQry = '';
		$contactLastNameQry = '';
	}

	// UNION to get the resource names from contacts and users table
    $query = "SELECT project_task.*, users.first_name, users.last_name FROM project_task, users ".
        " WHERE project_task.project_id=" . $projectTaskBean->db->quoted($_REQUEST['record']).
        " AND project_task.resource_id like users.id AND (users.last_name like ".
        $projectTaskBean->db->quoted($resource_name[0].'%') ." OR users.first_name like ".
        $projectTaskBean->db->quoted($resource_name[0].'%') .") " . $userLastNameQry . "AND project_task.deleted=0 ";
    $query .= "UNION ALL ";
    $query .= "SELECT project_task.*, contacts.first_name, contacts.last_name FROM project_task, contacts ".
        " WHERE project_task.project_id=" . $projectTaskBean->db->quoted($_REQUEST['record']) .
        " AND project_task.resource_id like contacts.id AND (contacts.last_name like ".
        $projectTaskBean->db->quoted($resource_name[0].'%') ." OR contacts.first_name like ".
        $projectTaskBean->db->quoted($resource_name[0].'%') .") " . $contactLastNameQry . "AND project_task.deleted=0 ";

    $result = $projectTaskBean->db->query($query, true, "");
}

// Tasks for date range
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 6) {
    //$query = "SELECT * FROM project_task WHERE project_task.project_id='" .$_REQUEST['record']."' AND project_task.date_start >= '". $_REQUEST['view_filter_date_start'] ."' AND project_task.date_finish <= '".$_REQUEST['view_filter_date_finish']."' AND project_task.deleted=0 order by project_task.project_task_id";
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']).
        " AND (project_task.date_start BETWEEN '". $timedate->to_db_date($_REQUEST['view_filter_date_start'], false) .
        "' AND '". $timedate->to_db_date($_REQUEST['view_filter_date_finish'], false)."' OR project_task.date_finish BETWEEN '".
        $timedate->to_db_date($_REQUEST['view_filter_date_start'], false) ."' AND '" . $timedate->to_db_date($_REQUEST['view_filter_date_finish'], false).
        "') AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
    $result = $projectTaskBean->db->query($query, true, "");
    $dotb_smarty->assign('VIEW_FILTER_DATE_START', $request->getValidInputRequest('view_filter_date_start'));
    $dotb_smarty->assign('VIEW_FILTER_DATE_FINISH', $request->getValidInputRequest('view_filter_date_finish'));
}

// Overdue Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 7) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) . " AND project_task.date_finish < '". $today .
        "' AND project_task.percent_complete < 100 AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
    $result = $projectTaskBean->db->query($query, true, "");
}
// Upcoming Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 8) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) . " AND " .
            "(project_task.date_start BETWEEN '" . $today . "' AND '". $nextWeek . "' OR ".
            "project_task.date_finish BETWEEN '". $today . "' AND '". $nextWeek . "') AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";

    $result = $projectTaskBean->db->query($query, true, "");
}
// My Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 9) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) . " AND project_task.resource_id like ".
        $projectTaskBean->db->quoted($current_user->id) . " AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
    $result = $projectTaskBean->db->query($query, true, "");
}
// My Overdue Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 10) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']). " AND project_task.resource_id like ".
        $projectTaskBean->db->quoted($current_user->id) ." AND " .
             "project_task.date_finish < '". $today . "' AND project_task.percent_complete < 100 AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";
    $result = $projectTaskBean->db->query($query, true, "");
}
// My Upcoming Tasks
elseif (isset($_REQUEST["selected_view"]) && $_REQUEST["selected_view"] == 11) {
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']). " AND project_task.resource_id like " .
        $projectTaskBean->db->quoted($current_user->id) ." AND " .
        "(project_task.date_start BETWEEN '" . $today . "' AND '". $nextWeek . "' OR ".
        "project_task.date_finish BETWEEN '". $today . "' AND '". $nextWeek . "') AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";

    $result = $projectTaskBean->db->query($query, true, "");
}
else
    $query = "SELECT * FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) .
        " AND project_task.deleted=0 {$queryPart} order by project_task.project_task_id";

if (!isset($_REQUEST["selected_view"]) || ($_REQUEST["selected_view"] == 0 || $_REQUEST["selected_view"] == 1 || $_REQUEST["selected_view"] == 3)) {
    $result = $projectTaskBean->db->query($query, true, "");

    $count = 0;
    while (($row = $projectTaskBean->db->fetchByAssoc($result)) != null) {
        $projectTask = BeanFactory::retrieveBean('ProjectTask', $row['id']);
        if(empty($projectTask)) continue;
        if (empty($projectTask->percent_complete))
            $projectTask->percent_complete = 0;
        if (empty($projectTask->duration))
            $projectTask->duration = 0;
        array_push($projectTasks, $projectTask);
        $count++;
    }
}
else {
    // Get all the tasks that participate in a parent relationship with any task.
    $query = "SELECT * from project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']).
        " AND project_task.project_task_id in (SELECT parent_task_id FROM project_task WHERE project_task.project_id=" .
        $projectTaskBean->db->quoted($_REQUEST['record']) . " AND project_task.deleted=0)";
    $parentResult = $projectTaskBean->db->query($query, true, "");
    $parentRows = array();

    while (($parentRow = $projectTaskBean->db->fetchByAssoc($parentResult)) != null) {
        $projectTask = BeanFactory::retrieveBean('ProjectTask', $parentRow['id']);
        if(empty($projectTask)) continue;
        $parentRows[$parentProjectTask->project_task_id] = $parentProjectTask;
    }

    while (($row = $projectTaskBean->db->fetchByAssoc($result)) != null) {
        $projectTask = BeanFactory::retrieveBean('ProjectTask', $row['id']);
        if(empty($projectTask)) continue;
        $projectTasks[$projectTask->project_task_id] = $projectTask;
        $parent = $projectTask->parent_task_id;
        while ($parent != null) {
            $parentProjectTask = $parentRows[$parent];
            $projectTasks[$parentProjectTask->project_task_id] = $parentProjectTask;
            $parent = $parentProjectTask->parent_task_id;
        }
    }
    ksort($projectTasks);
}


// Bug 47490 ensure the project task ids are continuous and begin with 1
// also make sure parent_task_id is correctly changed accordingly
$count = count($projectTasks);
$id_map = array(); // $id_map[<old_task_id>] = <new_task_id>

// first loop, construct the id_map and assign new project_task_id
for ($i = 0; $i < $count; $i++) {
    $id_map[$projectTasks[$i]->project_task_id] = $i + 1;
    $projectTasks[$i]->project_task_id = $i + 1;
}

// second loop, modify parent_project_id based on id_map
for ($i = 0; $i < $count; $i++) {
    if (!empty($projectTasks[$i]->parent_task_id) && isset($id_map[$projectTasks[$i]->parent_task_id])) {
        $projectTasks[$i]->parent_task_id = $id_map[$projectTasks[$i]->parent_task_id];
    } else {
        $projectTasks[$i]->parent_task_id = '';
    }
}
// end Bug 47490

$dotb_smarty->assign("TASKS", $projectTasks);
$dotb_smarty->assign("TASKCOUNT", $count);
$dotb_smarty->assign("BG_COLOR", $hilite_bg);
$dotb_smarty->assign("CALENDAR_DATEFORMAT", $timedate->get_cal_date_format());
$dotb_smarty->assign("TEAM", $focus->team_id);
$dotb_smarty->assign("OWNER", $focus->assigned_user_id);
$dotb_smarty->assign('NAME_LENGTH', $projectTaskBean->field_defs['name']['len']);

//todo: also add the owner's managers

global $current_user;
if(is_admin($current_user)
	&& $_REQUEST['module'] != 'DynamicLayout'
	&& !empty($_SESSION['editinplace']))
{
    $record = $request->getValidInputRequest('record', 'Assert\Guid');
    $action = $request->getValidInputRequest('action');
    $module = $request->getValidInputRequest('module', 'Assert\Mvc\ModuleName');

	$dotb_smarty->assign("ADMIN_EDIT","<a href='index.php?action=index&module=DynamicLayout&from_action="
        . $action . '&from_module=' . $module
		."&record=" .$record. "'>"
		.DotbThemeRegistry::current()->getImage("EditLayout","border='0' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDITLAYOUT'])."</a>");
}
$dotb_smarty->assign("DATE_FORMAT", $current_user->getPreference('datef'));
$dotb_smarty->assign("CURRENT_USER", $current_user->id);
$dotb_smarty->assign("CANEDIT",$current_user->id == $focus->assigned_user_id || $current_user->is_admin);

// Bug #43092
// Based on teamset ID, get a list of teams, and use that to check if this user
// can edit the gantt chart
$GLOBALS['log']->debug('EditGridView.php: Getting list of teams to determine access for editing gantt chart');

$list_of_teams = array();

if (isset($focus->team_set_id)) {
    $teamSet = BeanFactory::newBean('TeamSets');
    $list_of_teams  = $teamSet->getTeamIds($focus->team_set_id);
} else { // since no team_set_id exists, we can just use the current team id
    $list_of_teams[] = $focus->team_id;
}

// this checks to see if any teams in the project's teamset matches any teams
// in the project's list of teams.
$dotb_smarty->assign("CANEDIT",(bool)array_intersect(array_values($list_of_teams),array_keys($current_user->get_my_teams()))  || $current_user->id == $focus->assigned_user_id || $current_user->is_admin);

require_once('include/Dotbpdf/dotbpdf_config.php');
$dotb_smarty->assign("PDF_CLASS", PDF_CLASS);

echo $dotb_smarty->fetch('modules/Project/EditGridView.tpl');

$javascript = new javascript();
$javascript->setFormName('EditView');
$javascript->setDotbBean($focus);
$javascript->addAllFields('');
$javascript->addFieldGeneric('team_name', 'varchar', $app_strings['LBL_TEAM'] ,'true');
$javascript->addToValidateBinaryDependency('team_name', 'alpha', $app_strings['ERR_SQS_NO_MATCH_FIELD'] . $app_strings['LBL_TEAM'], 'false', '', 'team_id');
$javascript->addToValidateBinaryDependency('assigned_user_name', 'alpha', $app_strings['ERR_SQS_NO_MATCH_FIELD'] . $app_strings['LBL_ASSIGNED_TO'], 'false', '', 'assigned_user_id');

echo $javascript->getScript();
