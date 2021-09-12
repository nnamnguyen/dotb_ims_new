<?php

/**
 * Save functionality for Project
 */

require_once('include/formbase.php');

global $current_user;

$dotbbean = BeanFactory::newBean('Project');
$dotbbean = populateFromPost('', $dotbbean);

$projectTasks = array();
if (isset($_REQUEST['duplicateSave']) && $_REQUEST['duplicateSave'] === "true"){
    $base_project_id = $_REQUEST['relate_id'];
}
else{
    $base_project_id = $dotbbean->id;
}
if(isset($_REQUEST['save_type']) || isset($_REQUEST['duplicateSave']) && $_REQUEST['duplicateSave'] === "true") {
    $query = 'SELECT id FROM project_task WHERE project_id = ' . $dotbbean->db->quoted($base_project_id)
        . ' AND deleted = 0';
    $result = $dotbbean->db->query($query,true,"Error retrieving project tasks");
    $row = $dotbbean->db->fetchByAssoc($result);

    while ($row != null){
        $projectTaskBean = BeanFactory::newBean('ProjectTask');
        $projectTaskBean->id = $row['id'];
        $projectTaskBean->retrieve();
        $projectTaskBean->date_entered = '';
        $projectTaskBean->date_modified = '';
        array_push($projectTasks, $projectTaskBean);
        $row = $dotbbean->db->fetchByAssoc($result);
    }
}
if (isset($_REQUEST['save_type'])){
    $dotbbean->id = '';
    $dotbbean->assigned_user_id = $current_user->id;

    if ($_REQUEST['save_type'] == 'TemplateToProject'){
        $dotbbean->name = $_REQUEST['project_name'];
        $dotbbean->is_template = 0;
    }
    else if ($_REQUEST['save_type'] == 'ProjectToTemplate'){
        $dotbbean->name = $_REQUEST['template_name'];
        $dotbbean->is_template = true;
    }
}
else{
    if (isset($_REQUEST['is_template']) && $_REQUEST['is_template'] == '1'){
        $dotbbean->is_template = true;
    }
    else{
        $dotbbean->is_template = 0;
    }
}

if(isset($_REQUEST['email_id'])) $dotbbean->email_id = $_REQUEST['email_id'];

if(!$dotbbean->ACLAccess('Save')){
        ACLController::displayNoAccess(true);
        dotb_cleanup(true);
}

if (isset($GLOBALS['check_notify'])) {
    $check_notify = $GLOBALS['check_notify'];
}
else {
    $check_notify = FALSE;
}
$dotbbean->save($check_notify);
$return_id = $dotbbean->id;

if(isset($_REQUEST['save_type']) || isset($_REQUEST['duplicateSave']) && $_REQUEST['duplicateSave'] === "true") {
    for ($i = 0; $i < count($projectTasks); $i++){
        if (isset($_REQUEST['save_type']) || (isset($_REQUEST['duplicateSave']) && $_REQUEST['duplicateSave'] === "true")){
            $projectTasks[$i]->id = '';
            $projectTasks[$i]->project_id = $dotbbean->id;
        }
        if ($dotbbean->is_template){
            $projectTasks[$i]->assigned_user_id = '';
        }
        $projectTasks[$i]->team_id = $dotbbean->team_id;
        if(empty( $projectTasks[$i]->duration_unit)) $projectTasks[$i]->duration_unit = " "; //Since duration_unit cannot be null.
        $projectTasks[$i]->save(false);
    }
}

if ($dotbbean->is_template){
    header("Location: index.php?action=ProjectTemplatesDetailView&module=Project&record=$return_id&return_module=Project&return_action=ProjectTemplatesEditView");
}
else{
    handleRedirect($return_id,'Project');
}
?>
