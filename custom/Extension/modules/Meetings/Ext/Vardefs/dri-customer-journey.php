<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * custom/modules/Meetings/vardefs/addoptify-customer-journey.yml
 * and may be overwritten at a later point..
 */

$dictionary['Meeting']['fields']['dri_workflow_sort_order'] = array (
  'name' => 'dri_workflow_sort_order',
  'vname' => 'LBL_DRI_WORKFLOW_SORT_ORDER',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
  'default' => 1,
  'dependency' => 'not(equal($dri_subworkflow_id, ""))',
);

$dictionary['Meeting']['fields']['cj_actual_sort_order'] = array (
  'name' => 'cj_actual_sort_order',
  'vname' => 'LBL_CJ_ACTUAL_SORT_ORDER',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
  'dependency' => 'not(equal($dri_subworkflow_id, ""))',
);

$dictionary['Meeting']['fields']['customer_journey_score'] = array (
  'name' => 'customer_journey_score',
  'vname' => 'LBL_CUSTOMER_JOURNEY_SCORE',
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
);

$dictionary['Meeting']['fields']['cj_momentum_points'] = array (
  'name' => 'cj_momentum_points',
  'vname' => 'LBL_CJ_MOMENTUM_POINTS',
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
);

$dictionary['Meeting']['fields']['cj_momentum_score'] = array (
  'name' => 'cj_momentum_score',
  'vname' => 'LBL_CJ_MOMENTUM_SCORE',
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
);

$dictionary['Meeting']['fields']['customer_journey_progress'] = array (
  'name' => 'customer_journey_progress',
  'vname' => 'LBL_CUSTOMER_JOURNEY_PROGRESS',
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
);

$dictionary['Meeting']['fields']['cj_momentum_ratio'] = array (
  'name' => 'cj_momentum_ratio',
  'vname' => 'LBL_CJ_MOMENTUM_RATIO',
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
);

$dictionary['Meeting']['fields']['customer_journey_points'] = array (
  'name' => 'customer_journey_points',
  'vname' => 'LBL_CUSTOMER_JOURNEY_POINTS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_task_templates_points_list',
  'type' => 'enum',
  'dependency' => 'not(equal($dri_subworkflow_id, ""))',
  'default' => 10,
  'dbType' => 'int',
  'len' => 3,
);

$dictionary['Meeting']['fields']['cj_parent_activity_type'] = array (
  'name' => 'cj_parent_activity_type',
  'vname' => 'LBL_CJ_PARENT_ACTIVITY_TYPE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_cj_parent_activity_type_list',
  'type' => 'enum',
);

$dictionary['Meeting']['fields']['customer_journey_blocked_by'] = array (
  'name' => 'customer_journey_blocked_by',
  'vname' => 'LBL_CUSTOMER_JOURNEY_BLOCKED_BY',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'json',
  'dbType' => 'text',
  'isMultiSelect' => true,
);

$dictionary['Meeting']['fields']['cj_parent_activity_id'] = array (
  'name' => 'cj_parent_activity_id',
  'vname' => 'LBL_CJ_PARENT_ACTIVITY_ID',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['Meeting']['fields']['is_cj_parent_activity'] = array (
  'name' => 'is_cj_parent_activity',
  'vname' => 'LBL_IS_CJ_PARENT_ACTIVITY',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => '0',
);

$dictionary['Meeting']['fields']['is_customer_journey_activity'] = array (
  'name' => 'is_customer_journey_activity',
  'vname' => 'LBL_IS_CUSTOMER_JOURNEY_ACTIVITY',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => '0',
  'enforced' => true,
  'calculated' => true,
  'formula' => 'not(equal($dri_subworkflow_id, ""))',
);

$dictionary['Meeting']['fields']['dri_subworkflow_link'] = array (
  'name' => 'dri_subworkflow_link',
  'vname' => 'LBL_DRI_SUBWORKFLOW',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_SubWorkflow',
  'relationship' => 'meeting_dri_subworkflows',
  'module' => 'DRI_SubWorkflows',
);

$dictionary['Meeting']['fields']['current_cj_activity_at'] = array (
  'name' => 'current_cj_activity_at',
  'vname' => 'LBL_CURRENT_CJ_ACTIVITY_AT',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow',
  'relationship' => 'meetings_flex_relate_dri_workflows',
  'module' => 'DRI_Workflows',
);

$dictionary['Meeting']['fields']['cj_momentum_start_date'] = array (
  'name' => 'cj_momentum_start_date',
  'vname' => 'LBL_CJ_MOMENTUM_START_DATE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'datetime',
);

$dictionary['Meeting']['fields']['cj_momentum_end_date'] = array (
  'name' => 'cj_momentum_end_date',
  'vname' => 'LBL_CJ_MOMENTUM_END_DATE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'datetime',
);

$dictionary['Meeting']['fields']['cj_url'] = array (
  'name' => 'cj_url',
  'vname' => 'LBL_CJ_URL',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'url',
  'dbType' => 'varchar',
);

$dictionary['Meeting']['fields']['dri_workflow_template_id'] = array (
  'name' => 'dri_workflow_template_id',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['Meeting']['fields']['dri_workflow_template_name'] = array (
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

$dictionary['Meeting']['fields']['dri_workflow_template_link'] = array (
  'name' => 'dri_workflow_template_link',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'meeting_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['Meeting']['fields']['dri_subworkflow_template_id'] = array (
  'name' => 'dri_subworkflow_template_id',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['Meeting']['fields']['dri_subworkflow_template_name'] = array (
  'name' => 'dri_subworkflow_template_name',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'required' => false,
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

$dictionary['Meeting']['fields']['dri_subworkflow_template_link'] = array (
  'name' => 'dri_subworkflow_template_link',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_SubWorkflow_Template',
  'relationship' => 'meeting_dri_subworkflow_templates',
  'module' => 'DRI_SubWorkflow_Templates',
);

$dictionary['Meeting']['fields']['dri_workflow_task_template_id'] = array (
  'name' => 'dri_workflow_task_template_id',
  'vname' => 'LBL_DRI_WORKFLOW_TASK_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['Meeting']['fields']['cj_activity_tpl_name'] = array (
  'name' => 'cj_activity_tpl_name',
  'vname' => 'LBL_DRI_WORKFLOW_TASK_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflow_task_templates',
  'id_name' => 'dri_workflow_task_template_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflow_Task_Templates',
  'link' => 'cj_activity_tpl_link',
);

$dictionary['Meeting']['fields']['cj_activity_tpl_link'] = array (
  'name' => 'cj_activity_tpl_link',
  'vname' => 'LBL_DRI_WORKFLOW_TASK_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'meeting_dri_workflow_task_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['Meeting']['fields']['dri_subworkflow_id'] = array (
  'name' => 'dri_subworkflow_id',
  'vname' => 'LBL_DRI_SUBWORKFLOW',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['Meeting']['fields']['dri_subworkflow_name'] = array (
  'name' => 'dri_subworkflow_name',
  'vname' => 'LBL_DRI_SUBWORKFLOW',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_subworkflows',
  'id_name' => 'dri_subworkflow_id',
  'sort_on' => 'name',
  'module' => 'DRI_SubWorkflows',
  'link' => 'dri_subworkflow_link',
);

$dictionary['Meeting']['relationships']['meetings_flex_relate_dri_workflows'] = array (
  'lhs_key' => 'id',
  'relationship_type' => 'one-to-many',
  'lhs_module' => 'Meetings',
  'lhs_table' => 'meetings',
  'rhs_key' => 'parent_id',
  'rhs_module' => 'DRI_Workflows',
  'rhs_table' => 'dri_workflows',
  'relationship_role_column_value' => 'Meetings',
  'relationship_role_column' => 'parent_type',
);

$dictionary['Meeting']['relationships']['meeting_dri_workflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_module' => 'Meetings',
  'rhs_table' => 'meetings',
  'rhs_key' => 'dri_workflow_template_id',
);

$dictionary['Meeting']['relationships']['meeting_dri_subworkflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_SubWorkflow_Templates',
  'lhs_table' => 'dri_subworkflow_templates',
  'rhs_module' => 'Meetings',
  'rhs_table' => 'meetings',
  'rhs_key' => 'dri_subworkflow_template_id',
);

$dictionary['Meeting']['relationships']['meeting_dri_workflow_task_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Task_Templates',
  'lhs_table' => 'dri_workflow_task_templates',
  'rhs_module' => 'Meetings',
  'rhs_table' => 'meetings',
  'rhs_key' => 'dri_workflow_task_template_id',
);

$dictionary['Meeting']['relationships']['meeting_dri_subworkflows'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_SubWorkflows',
  'lhs_table' => 'dri_subworkflows',
  'rhs_module' => 'Meetings',
  'rhs_table' => 'meetings',
  'rhs_key' => 'dri_subworkflow_id',
);

$dictionary['Meeting']['indices']['idx_meeting_cj_journey_tpl_id'] = array (
  'name' => 'idx_meeting_cj_journey_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_template_id',
  ),
);

$dictionary['Meeting']['indices']['idx_meeting_cj_stage_tpl_id'] = array (
  'name' => 'idx_meeting_cj_stage_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_subworkflow_template_id',
  ),
);

$dictionary['Meeting']['indices']['idx_meeting_cj_activity_tpl_id'] = array (
  'name' => 'idx_meeting_cj_activity_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_task_template_id',
  ),
);

$dictionary['Meeting']['indices']['idx_meeting_cj_stage_id'] = array (
  'name' => 'idx_meeting_cj_stage_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_subworkflow_id',
  ),
);

$dictionary['Meeting']['indices']['idx_meeting_cj_parent_activity'] = array (
  'name' => 'idx_meeting_cj_parent_activity',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'deleted',
    1 => 'cj_parent_activity_id',
    2 => 'cj_parent_activity_type',
  ),
);
