<?php

/**
 * Side-bar menu for Project
 */
global $current_user;
global $mod_strings, $app_strings;
$module_menu = array();

// Each index of module_menu must be an array of:
// the link url, display text for the link, and the icon name.

// Create Project
if(ACLController::checkAccess('Project', 'edit', true)) {
    $module_menu[] = array(
        'index.php?module=Project&action=EditView&return_module=Project&return_action=DetailView',
        isset($mod_strings['LNK_NEW_PROJECT']) ? $mod_strings['LNK_NEW_PROJECT'] : '',
        'CreateProject'
    );
}

// Create Project Template
if(ACLController::checkAccess('Project', 'edit', true)) {
    $module_menu[] = array(
        'index.php?module=Project&action=ProjectTemplatesEditView&return_module=Project&return_action=ProjectTemplatesDetailView',
        isset($mod_strings['LNK_NEW_PROJECT_TEMPLATES']) ? $mod_strings['LNK_NEW_PROJECT_TEMPLATES'] : '',
        'CreateProjectTemplate'
    );
}
	
// Project List
if(ACLController::checkAccess('Project', 'list', true)) {
    $module_menu[] = array(
        'index.php?module=Project&action=index',
        isset($mod_strings['LNK_PROJECT_LIST']) ? $mod_strings['LNK_PROJECT_LIST'] : '',
        'Project'
    );
}
	
// Project Templates
if(ACLController::checkAccess('Project', 'list', true)) {
    $module_menu[] = array(
        'index.php?module=Project&action=ProjectTemplatesListView',
        isset($mod_strings['LNK_PROJECT_TEMPLATES_LIST']) ? $mod_strings['LNK_PROJECT_TEMPLATES_LIST'] : '',
        'ProjectTemplate'
    );
}
	
// Project Tasks
if(ACLController::checkAccess('ProjectTask', 'list', true)) {
    $module_menu[] = array(
        'index.php?module=ProjectTask&action=index',
        isset($mod_strings['LNK_PROJECT_TASK_LIST']) ? $mod_strings['LNK_PROJECT_TASK_LIST'] : '',
        'ProjectTask'
    );
}
	
if(ACLController::checkAccess('Project', 'list', true)) {
    $module_menu[] = array(
        "index.php?module=Project&action=Dashboard&return_module=Project&return_action=DetailView",
        isset($mod_strings['LNK_PROJECT_DASHBOARD']) ? $mod_strings['LNK_PROJECT_DASHBOARD'] : '',
        'Project'
    );
}

?>
