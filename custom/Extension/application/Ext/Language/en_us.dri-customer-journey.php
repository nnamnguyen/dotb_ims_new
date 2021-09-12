<?php

/*****************************************************************************/
/******************** DRI_SubWorkflows Language ******************************/
/*****************************************************************************/
$app_strings['LBL_DRI_SUBWORKFLOWS'] = 'Customer Insight Stages';
$app_strings['LBL_DRI_SUBWORKFLOW'] = 'Customer Insight Stage';
$app_list_strings['moduleList']['DRI_SubWorkflows'] = 'Customer Insight Stages';
$app_list_strings['moduleListSingular']['DRI_SubWorkflows'] = 'Customer Insight Stage';

$app_list_strings['dri_subworkflows_state_list'] = array (
    'not_started' => 'Not Started',
    'in_progress' => 'In Progress',
    'not_completed' => 'Not Completed',
    'completed' => 'Completed',
);

/*****************************************************************************/
/******************** DRI_SubWorkflow_Templates Language *********************/
/*****************************************************************************/
$app_strings['LBL_DRI_SUBWORKFLOW_TEMPLATES'] = 'Customer Insight Stage Templates';
$app_strings['LBL_DRI_SUBWORKFLOW_TEMPLATE'] = 'Customer Insight Stage Template';
$app_list_strings['moduleList']['DRI_SubWorkflow_Templates'] = 'Customer Insight Stage Templates';
$app_list_strings['moduleListSingular']['DRI_SubWorkflow_Templates'] = 'Customer Insight Stage Template';

/*****************************************************************************/
/******************** DRI_Workflows Language *********************************/
/*****************************************************************************/
$app_strings['LBL_DRI_WORKFLOWS'] = 'Customer Insights';
$app_strings['LBL_DRI_WORKFLOW'] = 'Customer Insight';
$app_list_strings['moduleList']['DRI_Workflows'] = 'Customer Insights';
$app_list_strings['moduleListSingular']['DRI_Workflows'] = 'Customer Insight';

$app_list_strings['dri_workflows_state_list'] = array (
    'not_started' => 'Not Started',
    'in_progress' => 'In Progress',
    'completed' => 'Completed',
);

$app_list_strings['dri_workflows_parent_type_list'] = array (
    'Tasks' => 'Current Task',
    'Calls' => 'Current Call',
    'Meetings' => 'Current Meeting',
);

/*****************************************************************************/
/******************** DRI_Workflow_Task_Templates Language *******************/
/*****************************************************************************/
$app_strings['LBL_DRI_WORKFLOW_TASK_TEMPLATES'] = 'Customer Insight Activity Templates';
$app_strings['LBL_DRI_WORKFLOW_TASK_TEMPLATE'] = 'Customer Insight Activity Template';
$app_strings['LBL_DRI_WORKFLOW_TASK_TEMPLATES_SUBPANEL_TITLE'] = 'Activity Templates';
$app_list_strings['moduleList']['DRI_Workflow_Task_Templates'] = 'Customer Insight Activity Templates';
$app_list_strings['moduleListSingular']['DRI_Workflow_Task_Templates'] = 'Customer Insight Activity Template';

$app_list_strings['dri_workflow_task_templates_type_list'] = array (
    '' => '',
    'customer_task' => 'Customer Task',
    'milestone' => 'Milestone',
    'internal_task' => 'Internal Task',
    'agency_task' => 'Agency Task',
    'automatic_task' => 'Automatic Task',
);

$app_list_strings['dri_workflow_task_templates_activity_type_list'] = array (
    'Tasks' => 'Task',
    'Calls' => 'Call',
    'Meetings' => 'Meeting',
);

$app_list_strings['dri_workflow_task_templates_points_list'] = array (
    10 => '10',
    9 => '9',
    8 => '8',
    7 => '7',
    6 => '6',
    5 => '5',
    4 => '4',
    3 => '3',
    2 => '2',
    1 => '1',
);

$app_list_strings['dri_workflow_task_templates_send_invites_list'] = array (
    'none' => 'None',
    'create' => 'On Create',
    'stage_start' => 'On Stage Start',
);

$app_list_strings['dri_workflow_task_templates_due_date_field_list'] = array (
    '' => '',
);

$app_list_strings['dri_workflow_task_templates_task_due_date_type_list'] = array (
    '' => '',
    'days_from_created' => 'Days From Created',
    'days_from_stage_started' => 'Days From Stage Started',
    'days_from_previous_activity_completed' => 'Days From Previous Activity Completed',
    'days_from_parent_date_field' => 'Days From Parent Date Field',
);

$app_list_strings['dri_workflow_task_templates_momentum_start_type_list'] = array (
    '' => '',
    'created' => 'When Created',
    'stage_started' => 'When Stage Started',
    'previous_activity_completed' => 'When Previous Activity Completed',
    'parent_date_field' => 'On Parent Date Field',
);

$app_list_strings['dri_workflow_task_templates_momentum_points_list'] = array (
    100 => '100',
    90 => '90',
    80 => '80',
    70 => '70',
    60 => '60',
    50 => '50',
    40 => '40',
    30 => '30',
    20 => '20',
    10 => '10',
);

/*****************************************************************************/
/******************** DRI_Workflow_Templates Language ************************/
/*****************************************************************************/
$app_strings['LBL_DRI_WORKFLOW_TEMPLATES'] = 'Customer Insight Templates';
$app_strings['LBL_DRI_WORKFLOW_TEMPLATE'] = 'Customer Insight Template';
$app_list_strings['moduleList']['DRI_Workflow_Templates'] = 'Customer Insight Templates';
$app_list_strings['moduleListSingular']['DRI_Workflow_Templates'] = 'Customer Insight Template';

$app_list_strings['dri_workflow_templates_available_modules_list']['Leads'] = 'Lead';
$app_list_strings['dri_workflow_templates_available_modules_list']['Companies'] = 'Company';
$app_list_strings['dri_workflow_templates_available_modules_list']['Contacts'] = 'Contact';
$app_list_strings['dri_workflow_templates_available_modules_list']['Cases'] = 'Case';
$app_list_strings['dri_workflow_templates_available_modules_list']['Opportunities'] = 'Opportunity';

$app_list_strings['dri_workflow_templates_target_assignee_list'] = array (
    'current_user' => 'Current User',
    'parent_assignee' => 'Parent Assignee',
);

$app_list_strings['dri_workflow_task_templates_target_assignee_list'] = array (
    'inherit' => 'Inherit',
    'current_user' => 'Current User',
    'parent_assignee' => 'Parent Assignee',
    'user' => 'User',
    'team' => 'Team',
);

$app_list_strings['dri_workflow_templates_assignee_rule_list'] = array (
    'none' => 'None',
    'create' => 'On Create',
    'stage_start' => 'On Stage Start',
    'previous_activity_completed' => 'Previous Activity Completed',
);

$app_list_strings['dri_workflow_task_templates_assignee_rule_list'] = array (
    'inherit' => 'Inherit',
    'none' => 'None',
    'create' => 'On Create',
    'stage_start' => 'On Stage Start',
    'previous_activity_completed' => 'Previous Activity Completed',
);

$app_list_strings['dri_workflow_templates_disabled_stage_actions_list'] = array (
    'stage_edit_button' => 'Edit Stage',
    'stage_add_task_button' => 'Create Task',
    'stage_add_meeting_button' => 'Schedule Meeting',
    'stage_add_call_button' => 'Schedule Call',
    'stage_delete_button' => 'Delete Stage',
);

$app_list_strings['dri_workflow_templates_disabled_activity_actions_list'] = array (
    'activity_add_sub_task_button' => 'Add Task',
    'activity_add_sub_meeting_button' => 'Schedule Meeting',
    'activity_add_sub_call_button' => 'Schedule Call',
    'activity_not_applicable_button' => 'Not Applicable',
);

/********************************* CJ_Forms Language *************************/
/*****************************************************************************/

$app_strings['LBL_CJ_FORMS'] = 'Customer Insight Related Dotb Actions';
$app_strings['LBL_CJ_FORM'] = 'Customer Insight Related Dotb Action';
$app_strings['LBL_CJ_FORMS_SUBPANEL_TITLE'] = 'Related Dotb Actions';
$app_list_strings['moduleList']['CJ_Forms'] = 'Customer Insight Related Dotb Actions';
$app_list_strings['moduleListSingular']['CJ_Forms'] = 'Customer Insight Related Dotb Action';

$app_list_strings['cj_forms_trigger_event_list'] = array (
    '' => '',
    'in_progress' => 'In Progress',
    'completed' => 'Completed',
    'not_applicable' => 'Not Applicable',
);

$app_list_strings['cj_forms_action_type_list'] = array (
    '' => '',
    'view_record' => 'View Record',
    'create_record' => 'Create Record',
    'update_record' => 'Update Record',
);

/*****************************************************************************/
/************************* CJ_WebHooks Language ******************************/
/*****************************************************************************/
$app_strings['LBL_CJ_WEBHOOKS'] = 'Customer Insight Web Hooks';
$app_strings['LBL_CJ_WEBHOOK'] = 'Customer Insight Web Hook';
$app_strings['LBL_CJ_WEBHOOKS_SUBPANEL_TITLE'] = 'Web Hooks';
$app_list_strings['moduleList']['CJ_WebHooks'] = 'Customer Insight Web Hooks';
$app_list_strings['moduleListSingular']['CJ_WebHooks'] = 'Customer Insight Web Hook';

$app_list_strings['cj_webhooks_request_method_list'] = array (
    'GET' => 'GET',
    'POST' => 'POST',
    'PUT' => 'PUT',
    'PATCH' => 'PATCH',
    'DELETE' => 'DELETE',
);

$app_list_strings['cj_webhooks_request_format_list'] = array (
    'skip_request' => 'Skip Request',
    'json' => 'JSON',
    'http_query' => 'HTTP Query',
);

$app_list_strings['cj_webhooks_response_format_list'] = array (
    'no_response' => 'No Response',
    'json' => 'JSON',
    'http_query' => 'HTTP Query',
    'text' => 'Plain Text',
);

$app_list_strings['cj_webhooks_trigger_event_list'] = array (
    'before_create' => 'Before Create',
    'after_create' => 'After Create',
    'before_in_progress' => 'Before In Progress',
    'after_in_progress' => 'After In Progress',
    'before_completed' => 'Before Completed',
    'after_completed' => 'After Completed',
    'before_not_applicable' => 'Before Not Applicable',
    'after_not_applicable' => 'After Not Applicable',
    'before_delete' => 'Before Delete',
    'after_delete' => 'After Delete',
);

$app_list_strings['cj_webhooks_parent_type_list'] = array (
    'DRI_Workflow_Templates' => 'Customer Insight Template',
    'DRI_SubWorkflow_Templates' => 'Stage Template',
    'DRI_Workflow_Task_Templates' => 'Activity Template',
);

/*****************************************************************************/
/******************************* Other Language ******************************/
/*****************************************************************************/

$app_list_strings['dri_cj_parent_activity_type_list'] = array (
    'Tasks' => 'Task',
    'Meetings' => 'Meeting',
    'Calls' => 'Call',
);

$app_list_strings['cj_calls_completed_status_list'] = array (
    'Held' => 'Held',
    'Not Held' => 'Not Held',
);

$app_list_strings['cj_meetings_completed_status_list'] = array (
    'Held' => 'Held',
    'Not Held' => 'Not Held',
);

$app_list_strings['cj_tasks_completed_status_list'] = array (
    'Completed' => 'Completed',
    'Not Applicable' => 'Not Applicable',
);

$app_strings['LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_DASHLET_TITLE'] = 'Customer Insight';
$app_strings['LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_DASHLET_DESC'] = 'Displays the Customer Insight pie chart.';
$app_strings['LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_MOMENTUM_DASHLET_TITLE'] = 'Customer Insight Momentum';
$app_strings['LBL_DEFAULT_DRI_CUSTOMER_JOURNEY_MOMENTUM_DASHLET_DESC'] = 'Displays the Customer Insight Momentum gauge chart.';
$app_strings['LBL_ASSIGN_ME_BUTTON_TITLE'] = 'Assign me';
$app_strings['LBL_COMPLETE_BUTTON_TITLE'] = 'Complete';
$app_strings['LBL_DELETE_STAGE_BUTTON_TITLE'] = 'Delete Stage';
$app_strings['LBL_START_CYCLE_BUTTON_TITLE'] = 'Start';
$app_strings['LBL_NOT_APPLICABLE_BUTTON_TITLE'] = 'Not Applicable';
$app_strings['LBL_ADD_STAGE_BUTTON_TITLE'] = 'Add Stage';
$app_strings['LBL_VIEW_JOURNEY_BUTTON_TITLE'] = 'View';
$app_strings['LBL_CANCEL_JOURNEY_BUTTON_TITLE'] = 'Cancel';
$app_strings['LBL_ARCHIVE_JOURNEY_BUTTON_TITLE'] = 'Archive';
$app_strings['LBL_UNARCHIVE_JOURNEY_BUTTON_TITLE'] = 'Un-archive';
$app_strings['LBL_CONFIGURE_TEMPLATE_BUTTON_TITLE'] = 'Configure';
$app_strings['LBL_CJ_CANCEL_CONFIRMATION'] = 'Are you sure that you want to cancel this journey?';
$app_strings['LBL_CJ_ARCHIVE_CONFIRMATION'] = 'Are you sure that you want to archive this journey?';
$app_strings['LBL_CJ_UNARCHIVE_CONFIRMATION'] = 'Are you sure that you want to un-archive this journey?';
$app_strings['LBL_ADD_CJ_SUB_TASK_BUTTON_TITLE'] = 'Add Task';
$app_strings['LBL_ADD_CJ_SUB_MEETING_BUTTON_TITLE'] = 'Schedule Meeting';
$app_strings['LBL_ADD_CJ_SUB_CALL_BUTTON_TITLE'] = 'Schedule Call';
$app_strings['LBL_CUSTOMER_JOURNEY_ACTIVITY_DUE_DATE_FUTURE'] = 'is in the future';
$app_strings['LBL_CUSTOMER_JOURNEY_ACTIVITY_DUE_DATE_OVERDUE'] = 'is overdue';
$app_strings['LBL_CUSTOMER_JOURNEY_ACTIVITY_DUE_DATE_TODAY'] = 'is today';
$app_strings['LBL_CUSTOMER_JOURNEY_ACTIVITY_DUE_DATE_TOMORROW'] = 'is tomorrow';
$app_strings['LBL_CUSTOMER_JOURNEY_ACTIVITY_DUE_DATE_TEXT'] = "{{fieldName}} {{status}}\n{{formatUser}} ({{fromNow}})";

$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_LICENSE_KEY_USER_LIMIT_REACHED'] = 'User Limit Reached';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_INVALID_LICENSE_KEY'] = 'Invalid License Key';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_INVALID_APPLICATION_LICENSE_KEY'] = 'Invalid Application';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_MISSING_LICENSE_KEY'] = 'Invalid Application';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_MISSING_VALIDATION_KEY'] = 'Missing Validation Key';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_CORRUPT_VALIDATION_KEY'] = 'Corrupt Validation Key';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_LICENSE_KEY_EXPIRED'] = 'License Expired';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_LICENSE_KEY_MISSING_INFO'] = 'Missing Info';
$app_strings['LBL_CUSTOMER_JOURNEY_ERROR_USER_MISSING_ACCESS'] = 'User Missing Access';

$app_list_strings['task_status_dom']['Not Applicable'] = 'Not Applicable';

$app_strings['LBL_CUSTOMER_JOURNEY_INVALID_LICENSE'] = 'Invalid License';

$app_strings['LBL_CUSTOMER_JOURNEY_LICENSE_ABOUT_TO_EXPIRE_NAME'] = 'Customer Insight license is about to expire';
$app_strings['LBL_CUSTOMER_JOURNEY_LICENSE_ABOUT_TO_EXPIRE_DESCRIPTION'] = <<<TXT
Your Customer Insight license will expire {0} and needs to be renewed<br>
<br>
Please contact <a href="mailto:support@addoptify.com">support@addoptify.com</a> to extend the license and get a new validation key.
TXT;

$app_strings['LBL_CUSTOMER_JOURNEY_USER_LIMIT_REACHED_NAME'] = 'Customer Insight user limit reached';
$app_strings['LBL_CUSTOMER_JOURNEY_USER_LIMIT_REACHED_DESCRIPTION'] = <<<TXT
Your Customer Insight user limit of {0} has been exceeded<br>
<br>
Please contact <a href="mailto:support@addoptify.com">support@addoptify.com</a> to raise the user limit or decrease the number of users using the plugin.
TXT;
