<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/DRI_Workflow_Task_Templates/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['DRI_Workflow_Task_Template']['fields']['task_due_date_type'] = array (
  'name' => 'task_due_date_type',
  'vname' => 'LBL_TASK_DUE_DATE_TYPE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_task_due_date_type_list',
  'type' => 'enum',
  'visibility_grid' => 
  array (
    'trigger' => 'activity_type',
    'values' => 
    array (
      'Tasks' => 
      array (
        0 => '',
        1 => 'days_from_created',
        2 => 'days_from_stage_started',
        3 => 'days_from_previous_activity_completed',
        4 => 'days_from_parent_date_field',
      ),
      'Meetings' => 
      array (
        0 => 'days_from_created',
        1 => 'days_from_stage_started',
        2 => 'days_from_previous_activity_completed',
        3 => 'days_from_parent_date_field',
      ),
      'Calls' => 
      array (
        0 => 'days_from_created',
        1 => 'days_from_stage_started',
        2 => 'days_from_previous_activity_completed',
        3 => 'days_from_parent_date_field',
      ),
    ),
  ),
);

$dictionary['DRI_Workflow_Task_Template']['fields']['momentum_start_type'] = array (
  'name' => 'momentum_start_type',
  'vname' => 'LBL_MOMENTUM_START_TYPE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_momentum_start_type_list',
  'type' => 'enum',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['due_date_module'] = array (
  'name' => 'due_date_module',
  'vname' => 'LBL_DUE_DATE_MODULE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_available_modules_list',
  'type' => 'enum',
  'dependency' => 'equal($task_due_date_type, "days_from_parent_date_field")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['due_date_field'] = array (
  'name' => 'due_date_field',
  'vname' => 'LBL_DUE_DATE_FIELD',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_due_date_field_list',
  'type' => 'enum',
  'dependency' => 'equal($task_due_date_type, "days_from_parent_date_field")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['momentum_start_module'] = array (
  'name' => 'momentum_start_module',
  'vname' => 'LBL_MOMENTUM_START_MODULE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_available_modules_list',
  'type' => 'enum',
  'dependency' => 'equal($momentum_start_type, "parent_date_field")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['momentum_start_field'] = array (
  'name' => 'momentum_start_field',
  'vname' => 'LBL_MOMENTUM_START_FIELD',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_momentum_start_field_list',
  'type' => 'enum',
  'dependency' => 'equal($momentum_start_type, "parent_date_field")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['priority'] = array (
  'name' => 'priority',
  'vname' => 'LBL_PRIORITY',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'task_priority_dom',
  'type' => 'enum',
  'default' => 'Medium',
  'len' => 100,
  'dependency' => 'equal($activity_type, "Tasks")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['type'] = array (
  'name' => 'type',
  'vname' => 'LBL_TYPE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_type_list',
  'type' => 'enum',
  'default' => 'customer_task',
  'dependency' => 'equal($activity_type, "Tasks")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['activity_type'] = array (
  'name' => 'activity_type',
  'vname' => 'LBL_ACTIVITY_TYPE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_activity_type_list',
  'type' => 'enum',
  'default' => 'Tasks',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['duration_minutes'] = array (
  'name' => 'duration_minutes',
  'vname' => 'LBL_DURATION_MINUTES',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'duration_intervals',
  'type' => 'enum',
  'len' => 2,
  'default' => 0,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['direction'] = array (
  'name' => 'direction',
  'vname' => 'LBL_DIRECTION',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'call_direction_dom',
  'type' => 'enum',
  'len' => 100,
  'default' => 'Outbound',
  'dependency' => 'equal($activity_type, "Calls")',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['points'] = array (
  'name' => 'points',
  'vname' => 'LBL_POINTS',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_points_list',
  'type' => 'enum',
  'default' => 10,
  'dependency' => 'not($is_parent)',
  'dbType' => 'int',
  'len' => 3,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['momentum_points'] = array (
  'name' => 'momentum_points',
  'vname' => 'LBL_MOMENTUM_POINTS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_momentum_points_list',
  'type' => 'enum',
  'default' => 100,
  'dependency' => 'and(not($is_parent), not(equal($momentum_start_type, "")))',
  'dbType' => 'int',
  'len' => 8,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['send_invites'] = array (
  'name' => 'send_invites',
  'vname' => 'LBL_SEND_INVITES',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_send_invites_list',
  'type' => 'enum',
  'default' => 'none',
  'dependency' => 'or(equal($activity_type, "Meetings"), equal($activity_type, "Calls"))',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee'] = array (
  'name' => 'target_assignee',
  'vname' => 'LBL_TARGET_ASSIGNEE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_target_assignee_list',
  'type' => 'enum',
  'default' => 'inherit',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['assignee_rule'] = array (
  'name' => 'assignee_rule',
  'vname' => 'LBL_ASSIGNEE_RULE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_assignee_rule_list',
  'type' => 'enum',
  'default' => 'inherit',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['time_of_day'] = array (
  'name' => 'time_of_day',
  'vname' => 'LBL_TIME_OF_DAY',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
  'dependency' => 'and(or(equal($activity_type, "Meetings"), equal($activity_type, "Calls")), not(equal($task_due_date_type, "")))',
  'default' => '12:00',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['sort_order'] = array (
  'name' => 'sort_order',
  'vname' => 'LBL_SORT_ORDER',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['task_due_days'] = array (
  'name' => 'task_due_days',
  'vname' => 'LBL_TASK_DUE_DAYS',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'dependency' => 'not(equal($task_due_date_type, ""))',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['momentum_due_days'] = array (
  'name' => 'momentum_due_days',
  'vname' => 'LBL_MOMENTUM_DUE_DAYS',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'dependency' => 'not(equal($momentum_start_type, ""))',
  'validation' => 
  array (
    'type' => 'range',
    'min' => 0,
  ),
);

$dictionary['DRI_Workflow_Task_Template']['fields']['momentum_due_hours'] = array (
  'name' => 'momentum_due_hours',
  'vname' => 'LBL_MOMENTUM_DUE_HOURS',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'dependency' => 'not(equal($momentum_start_type, ""))',
  'validation' => 
  array (
    'type' => 'range',
    'min' => 0,
  ),
);

$dictionary['DRI_Workflow_Task_Template']['fields']['duration_hours'] = array (
  'name' => 'duration_hours',
  'vname' => 'LBL_DURATION_HOURS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 3,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 1,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['duration'] = array (
  'name' => 'duration',
  'vname' => 'LBL_DURATION',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'source' => 'non-db',
  'dependency' => 'and(or(equal($activity_type, "Meetings"), equal($activity_type, "Calls")), not(equal($task_due_date_type, "")))',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['is_parent'] = array (
  'name' => 'is_parent',
  'vname' => 'LBL_IS_PARENT',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => false,
  'readonly' => true,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['tasks'] = array (
  'name' => 'tasks',
  'vname' => 'LBL_TASKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Task',
  'relationship' => 'task_dri_workflow_task_templates',
  'module' => 'Tasks',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['calls'] = array (
  'name' => 'calls',
  'vname' => 'LBL_CALLS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Call',
  'relationship' => 'call_dri_workflow_task_templates',
  'module' => 'Calls',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['meetings'] = array (
  'name' => 'meetings',
  'vname' => 'LBL_MEETINGS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Meeting',
  'relationship' => 'meeting_dri_workflow_task_templates',
  'module' => 'Meetings',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['children'] = array (
  'name' => 'children',
  'vname' => 'LBL_CHILDREN',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'dri_workflow_task_template_parent_dri_workflow_task_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['forms'] = array (
  'name' => 'forms',
  'vname' => 'LBL_FORMS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'CJ_Form',
  'relationship' => 'cj_form_activity_template_dri_workflow_task_templates',
  'module' => 'CJ_Forms',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['blocked_by'] = array (
  'name' => 'blocked_by',
  'vname' => 'LBL_BLOCKED_BY',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'json',
  'dbType' => 'text',
  'isMultiSelect' => true,
);

$dictionary['DRI_Workflow_Task_Template']['fields']['url'] = array (
  'name' => 'url',
  'vname' => 'LBL_URL',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'url',
  'dbType' => 'varchar',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['stage_template_label'] = array (
  'name' => 'stage_template_label',
  'vname' => 'LBL_STAGE_TEMPLATE_LABEL',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'label',
  'table' => 'dri_subworkflow_templates',
  'id_name' => 'dri_subworkflow_template_id',
  'sort_on' => 'stage_template_label',
  'module' => 'DRI_SubWorkflow_Templates',
  'link' => 'dri_subworkflow_template_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['stage_template_sort_order'] = array (
  'name' => 'stage_template_sort_order',
  'vname' => 'LBL_STAGE_TEMPLATE_SORT_ORDER',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'sort_order',
  'table' => 'dri_subworkflow_templates',
  'id_name' => 'dri_subworkflow_template_id',
  'sort_on' => 'stage_template_sort_order',
  'module' => 'DRI_SubWorkflow_Templates',
  'link' => 'dri_subworkflow_template_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['web_hooks'] = array (
  'name' => 'web_hooks',
  'vname' => 'LBL_WEB_HOOKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'CJ_WebHook',
  'relationship' => 'dri_workflow_task_templates_flex_relate_cj_web_hooks',
  'module' => 'CJ_WebHooks',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['dri_subworkflow_template_id'] = array (
  'name' => 'dri_subworkflow_template_id',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['dri_subworkflow_template_name'] = array (
  'name' => 'dri_subworkflow_template_name',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_subworkflow_templates',
  'id_name' => 'dri_subworkflow_template_id',
  'sort_on' => 'name',
  'module' => 'DRI_SubWorkflow_Templates',
  'link' => 'dri_subworkflow_template_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['dri_subworkflow_template_link'] = array (
  'name' => 'dri_subworkflow_template_link',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_SubWorkflow_Template',
  'relationship' => 'dri_workflow_task_template_dri_subworkflow_templates',
  'module' => 'DRI_SubWorkflow_Templates',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['dri_workflow_template_id'] = array (
  'name' => 'dri_workflow_template_id',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['dri_workflow_template_name'] = array (
  'name' => 'dri_workflow_template_name',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflow_templates',
  'id_name' => 'dri_workflow_template_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflow_Templates',
  'readonly' => true,
  'link' => 'dri_workflow_template_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['dri_workflow_template_link'] = array (
  'name' => 'dri_workflow_template_link',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'dri_workflow_task_template_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['blocked_by_id'] = array (
  'name' => 'blocked_by_id',
  'vname' => 'LBL_BLOCKED_BY',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['blocked_by_name'] = array (
  'name' => 'blocked_by_name',
  'vname' => 'LBL_BLOCKED_BY',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflow_task_templates',
  'id_name' => 'blocked_by_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflow_Task_Templates',
  'link' => 'blocked_by_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['blocked_by_link'] = array (
  'name' => 'blocked_by_link',
  'vname' => 'LBL_BLOCKED_BY',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'dri_workflow_task_template_blocked_by_dri_workflow_task_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee_user_id'] = array (
  'name' => 'target_assignee_user_id',
  'vname' => 'LBL_TARGET_ASSIGNEE_USER',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee_user_name'] = array (
  'name' => 'target_assignee_user_name',
  'vname' => 'LBL_TARGET_ASSIGNEE_USER',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'users',
  'id_name' => 'target_assignee_user_id',
  'sort_on' => 'name',
  'module' => 'Users',
  'dependency' => 'equal($target_assignee, "user")',
  'link' => 'target_assignee_user_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee_user_link'] = array (
  'name' => 'target_assignee_user_link',
  'vname' => 'LBL_TARGET_ASSIGNEE_USER',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'User',
  'relationship' => 'dri_workflow_task_template_target_assignee_user_users',
  'module' => 'Users',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee_team_id'] = array (
  'name' => 'target_assignee_team_id',
  'vname' => 'LBL_TARGET_ASSIGNEE_TEAM',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee_team_name'] = array (
  'name' => 'target_assignee_team_name',
  'vname' => 'LBL_TARGET_ASSIGNEE_TEAM',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'teams',
  'id_name' => 'target_assignee_team_id',
  'sort_on' => 'name',
  'module' => 'Teams',
  'dependency' => 'equal($target_assignee, "team")',
  'link' => 'target_assignee_team_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['target_assignee_team_link'] = array (
  'name' => 'target_assignee_team_link',
  'vname' => 'LBL_TARGET_ASSIGNEE_TEAM',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'Team',
  'relationship' => 'dri_workflow_task_template_target_assignee_team_teams',
  'module' => 'Teams',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['parent_id'] = array (
  'name' => 'parent_id',
  'vname' => 'LBL_PARENT',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['parent_name'] = array (
  'name' => 'parent_name',
  'vname' => 'LBL_PARENT',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflow_task_templates',
  'id_name' => 'parent_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflow_Task_Templates',
  'readonly' => true,
  'dependency' => 'not(equal($parent_id, ""))',
  'link' => 'parent_link',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['parent_link'] = array (
  'name' => 'parent_link',
  'vname' => 'LBL_PARENT',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'dri_workflow_task_template_parent_dri_workflow_task_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['DRI_Workflow_Task_Template']['fields']['name']['len'] = 50;

$dictionary['DRI_Workflow_Task_Template']['fields']['description']['full_text_search'] = array (
  'enabled' => false,
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_templates_flex_relate_cj_web_hooks'] = array (
  'lhs_key' => 'id',
  'relationship_type' => 'one-to-many',
  'lhs_module' => 'DRI_Workflow_Task_Templates',
  'lhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'parent_id',
  'rhs_module' => 'CJ_WebHooks',
  'rhs_table' => 'cj_web_hooks',
  'relationship_role_column_value' => 'DRI_Workflow_Task_Templates',
  'relationship_role_column' => 'parent_type',
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_template_dri_subworkflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_SubWorkflow_Templates',
  'lhs_table' => 'dri_subworkflow_templates',
  'rhs_module' => 'DRI_Workflow_Task_Templates',
  'rhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'dri_subworkflow_template_id',
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_template_dri_workflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_module' => 'DRI_Workflow_Task_Templates',
  'rhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'dri_workflow_template_id',
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_template_blocked_by_dri_workflow_task_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Task_Templates',
  'lhs_table' => 'dri_workflow_task_templates',
  'rhs_module' => 'DRI_Workflow_Task_Templates',
  'rhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'blocked_by_id',
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_template_target_assignee_user_users'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'Users',
  'lhs_table' => 'users',
  'rhs_module' => 'DRI_Workflow_Task_Templates',
  'rhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'target_assignee_user_id',
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_template_target_assignee_team_teams'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'Teams',
  'lhs_table' => 'teams',
  'rhs_module' => 'DRI_Workflow_Task_Templates',
  'rhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'target_assignee_team_id',
);

$dictionary['DRI_Workflow_Task_Template']['relationships']['dri_workflow_task_template_parent_dri_workflow_task_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Task_Templates',
  'lhs_table' => 'dri_workflow_task_templates',
  'rhs_module' => 'DRI_Workflow_Task_Templates',
  'rhs_table' => 'dri_workflow_task_templates',
  'rhs_key' => 'parent_id',
);

$dictionary['DRI_Workflow_Task_Template']['indices']['idx_cj_act_tpl_stage_tpl_id'] = array (
  'name' => 'idx_cj_act_tpl_stage_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_subworkflow_template_id',
  ),
);

$dictionary['DRI_Workflow_Task_Template']['indices']['idx_cj_act_tpl_jry_tpl_id'] = array (
  'name' => 'idx_cj_act_tpl_jry_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_template_id',
  ),
);

$dictionary['DRI_Workflow_Task_Template']['indices']['idx_cj_act_tpl_blocked_by_id'] = array (
  'name' => 'idx_cj_act_tpl_blocked_by_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'blocked_by_id',
  ),
);

$dictionary['DRI_Workflow_Task_Template']['indices']['idx_cj_act_tpl_trgt_asgn_us_id'] = array (
  'name' => 'idx_cj_act_tpl_trgt_asgn_us_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'target_assignee_user_id',
  ),
);

$dictionary['DRI_Workflow_Task_Template']['indices']['idx_cj_act_tpl_trgt_asgn_te_id'] = array (
  'name' => 'idx_cj_act_tpl_trgt_asgn_te_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'target_assignee_team_id',
  ),
);

$dictionary['DRI_Workflow_Task_Template']['indices']['idx_cj_act_tpl_parent_id'] = array (
  'name' => 'idx_cj_act_tpl_parent_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'parent_id',
  ),
);

$dictionary['DRI_Workflow_Task_Template']['duplicate_check']['enabled'] = false;

$dictionary['DRI_Workflow_Task_Template']['acls']['DotbACLCustomerJourney'] = true;
