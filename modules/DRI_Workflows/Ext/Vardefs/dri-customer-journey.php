<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/DRI_Workflows/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['DRI_Workflow']['fields']['available_modules'] = array (
  'name' => 'available_modules',
  'vname' => 'LBL_AVAILABLE_MODULES',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_available_modules_list',
  'type' => 'multienum',
  'isMultiSelect' => true,
);

$dictionary['DRI_Workflow']['fields']['enabled_modules'] = array (
  'name' => 'enabled_modules',
  'vname' => 'LBL_ENABLED_MODULES',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => NULL,
  'type' => 'multienum',
  'isMultiSelect' => true,
  'source' => 'non-db',
  'function' => 
  array (
    'include' => 'modules/DRI_Workflows/DRI_Workflow.php',
    'name' => 
    array (
      0 => 'DRI_Workflow',
      1 => 'listEnabledModulesEnumOptions',
    ),
  ),
);

$dictionary['DRI_Workflow']['fields']['state'] = array (
  'name' => 'state',
  'vname' => 'LBL_STATE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflows_state_list',
  'type' => 'enum',
  'default' => 'not_started',
  'readonly' => true,
);

$dictionary['DRI_Workflow']['fields']['assignee_rule'] = array (
  'name' => 'assignee_rule',
  'vname' => 'LBL_ASSIGNEE_RULE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_assignee_rule_list',
  'type' => 'enum',
  'default' => 'stage_start',
);

$dictionary['DRI_Workflow']['fields']['target_assignee'] = array (
  'name' => 'target_assignee',
  'vname' => 'LBL_TARGET_ASSIGNEE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_target_assignee_list',
  'type' => 'enum',
  'default' => 'current_user',
);

$dictionary['DRI_Workflow']['fields']['progress'] = array (
  'name' => 'progress',
  'vname' => 'LBL_PROGRESS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'float',
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 0,
  'readonly' => true,
  'validation' => 
  array (
    'type' => 'range',
    'min' => 0,
    'max' => 100,
  ),
);

$dictionary['DRI_Workflow']['fields']['momentum_ratio'] = array (
  'name' => 'momentum_ratio',
  'vname' => 'LBL_MOMENTUM_RATIO',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'float',
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 1,
  'readonly' => true,
  'validation' => 
  array (
    'type' => 'range',
    'min' => 0,
    'max' => 100,
  ),
);

$dictionary['DRI_Workflow']['fields']['score'] = array (
  'name' => 'score',
  'vname' => 'LBL_SCORE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'readonly' => true,
  'disable_num_format' => true,
);

$dictionary['DRI_Workflow']['fields']['points'] = array (
  'name' => 'points',
  'vname' => 'LBL_POINTS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'readonly' => true,
  'disable_num_format' => true,
);

$dictionary['DRI_Workflow']['fields']['momentum_points'] = array (
  'name' => 'momentum_points',
  'vname' => 'LBL_MOMENTUM_POINTS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 0,
  'readonly' => true,
  'disable_num_format' => true,
);

$dictionary['DRI_Workflow']['fields']['momentum_score'] = array (
  'name' => 'momentum_score',
  'vname' => 'LBL_MOMENTUM_SCORE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 0,
  'readonly' => true,
  'disable_num_format' => true,
);

$dictionary['DRI_Workflow']['fields']['dri_subworkflows'] = array (
  'name' => 'dri_subworkflows',
  'vname' => 'LBL_DRI_SUBWORKFLOWS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_SubWorkflow',
  'relationship' => 'dri_subworkflow_dri_workflows',
  'module' => 'DRI_SubWorkflows',
);

$dictionary['DRI_Workflow']['fields']['current_activity_task'] = array (
  'name' => 'current_activity_task',
  'vname' => 'LBL_CURRENT_ACTIVITY_TASK',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Task',
  'relationship' => 'tasks_flex_relate_dri_workflows',
  'module' => 'Tasks',
);

$dictionary['DRI_Workflow']['fields']['current_activity_call'] = array (
  'name' => 'current_activity_call',
  'vname' => 'LBL_CURRENT_ACTIVITY_CALL',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Call',
  'relationship' => 'calls_flex_relate_dri_workflows',
  'module' => 'Calls',
);

$dictionary['DRI_Workflow']['fields']['current_activity_meeting'] = array (
  'name' => 'current_activity_meeting',
  'vname' => 'LBL_CURRENT_ACTIVITY_MEETING',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Meeting',
  'relationship' => 'meetings_flex_relate_dri_workflows',
  'module' => 'Meetings',
);

$dictionary['DRI_Workflow']['fields']['parent_id'] = array (
  'name' => 'parent_id',
  'vname' => 'LBL_PARENT_ID',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
  'readonly' => true,
);

$dictionary['DRI_Workflow']['fields']['parent_name'] = array (
  'name' => 'parent_name',
  'vname' => 'LBL_PARENT_NAME',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'parent',
  'len' => 255,
  'source' => 'non-db',
  'options' => 'dri_workflows_parent_type_list',
  'parent_type' => 'dri_workflows_parent_type_list',
  'readonly' => true,
  'id_name' => 'parent_id',
  'type_name' => 'parent_type',
);

$dictionary['DRI_Workflow']['fields']['parent_type'] = array (
  'name' => 'parent_type',
  'vname' => 'LBL_PARENT_TYPE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'parent_type',
  'len' => 255,
  'dbType' => 'varchar',
  'options' => 'dri_workflows_parent_type_list',
  'parent_type' => 'dri_workflows_parent_type_list',
  'readonly' => true,
);

$dictionary['DRI_Workflow']['fields']['date_started'] = array (
  'name' => 'date_started',
  'vname' => 'LBL_DATE_STARTED',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'datetime',
  'readonly' => true,
);

$dictionary['DRI_Workflow']['fields']['date_completed'] = array (
  'name' => 'date_completed',
  'vname' => 'LBL_DATE_COMPLETED',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'datetime',
  'readonly' => true,
);

$dictionary['DRI_Workflow']['fields']['archived'] = array (
  'name' => 'archived',
  'vname' => 'LBL_ARCHIVED',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => '0',
);

$dictionary['DRI_Workflow']['fields']['dri_workflow_template_id'] = array (
  'name' => 'dri_workflow_template_id',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow']['fields']['dri_workflow_template_name'] = array (
  'name' => 'dri_workflow_template_name',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => false,
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
  'link' => 'dri_workflow_template_link',
);

$dictionary['DRI_Workflow']['fields']['dri_workflow_template_link'] = array (
  'name' => 'dri_workflow_template_link',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'dri_workflow_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['DRI_Workflow']['fields']['current_stage_id'] = array (
  'name' => 'current_stage_id',
  'vname' => 'LBL_CURRENT_STAGE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow']['fields']['current_stage_name'] = array (
  'name' => 'current_stage_name',
  'vname' => 'LBL_CURRENT_STAGE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_subworkflows',
  'id_name' => 'current_stage_id',
  'sort_on' => 'name',
  'module' => 'DRI_SubWorkflows',
  'readonly' => true,
  'link' => 'current_stage_link',
);

$dictionary['DRI_Workflow']['fields']['current_stage_link'] = array (
  'name' => 'current_stage_link',
  'vname' => 'LBL_CURRENT_STAGE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_SubWorkflow',
  'relationship' => 'dri_workflow_current_stage_dri_subworkflows',
  'module' => 'DRI_SubWorkflows',
);

$dictionary['DRI_Workflow']['fields']['name']['readonly'] = true;

$dictionary['DRI_Workflow']['fields']['description']['readonly'] = true;
$dictionary['DRI_Workflow']['fields']['description']['full_text_search'] = array (
  'enabled' => false,
);

$dictionary['DRI_Workflow']['relationships']['dri_workflow_dri_workflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_module' => 'DRI_Workflows',
  'rhs_table' => 'dri_workflows',
  'rhs_key' => 'dri_workflow_template_id',
);

$dictionary['DRI_Workflow']['relationships']['dri_workflow_current_stage_dri_subworkflows'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_SubWorkflows',
  'lhs_table' => 'dri_subworkflows',
  'rhs_module' => 'DRI_Workflows',
  'rhs_table' => 'dri_workflows',
  'rhs_key' => 'current_stage_id',
);

$dictionary['DRI_Workflow']['indices']['idx_parent_id'] = array (
  'name' => 'idx_parent_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'parent_id',
  ),
);

$dictionary['DRI_Workflow']['indices']['idx_cj_journey_tpl_id'] = array (
  'name' => 'idx_cj_journey_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_template_id',
  ),
);

$dictionary['DRI_Workflow']['indices']['idx_cj_jry_current_stage_id'] = array (
  'name' => 'idx_cj_jry_current_stage_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'current_stage_id',
  ),
);

$dictionary['DRI_Workflow']['duplicate_check']['enabled'] = false;

$dictionary['DRI_Workflow']['acls']['DotbACLCustomerJourney'] = true;
