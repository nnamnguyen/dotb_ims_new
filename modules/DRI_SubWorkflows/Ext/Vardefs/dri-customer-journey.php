<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/DRI_SubWorkflows/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['DRI_SubWorkflow']['fields']['label'] = array (
  'name' => 'label',
  'vname' => 'LBL_LABEL',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
  'readonly' => true,
);

$dictionary['DRI_SubWorkflow']['fields']['state'] = array (
  'name' => 'state',
  'vname' => 'LBL_STATE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_subworkflows_state_list',
  'type' => 'enum',
  'default' => 'not_started',
  'readonly' => true,
);

$dictionary['DRI_SubWorkflow']['fields']['progress'] = array (
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

$dictionary['DRI_SubWorkflow']['fields']['momentum_ratio'] = array (
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
  'readonly' => true,
  'default' => 1,
  'validation' => 
  array (
    'type' => 'range',
    'min' => 0,
    'max' => 100,
  ),
);

$dictionary['DRI_SubWorkflow']['fields']['score'] = array (
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
  'default' => 0,
  'readonly' => true,
  'disable_num_format' => true,
);

$dictionary['DRI_SubWorkflow']['fields']['points'] = array (
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
  'default' => 0,
  'readonly' => true,
  'disable_num_format' => true,
);

$dictionary['DRI_SubWorkflow']['fields']['momentum_points'] = array (
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

$dictionary['DRI_SubWorkflow']['fields']['momentum_score'] = array (
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

$dictionary['DRI_SubWorkflow']['fields']['sort_order'] = array (
  'name' => 'sort_order',
  'vname' => 'LBL_SORT_ORDER',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
  'default' => 1,
  'readonly' => false,
  'validation' => 
  array (
    'type' => 'range',
    'min' => 1,
    'max' => 1000,
  ),
);

$dictionary['DRI_SubWorkflow']['fields']['current_stage_at'] = array (
  'name' => 'current_stage_at',
  'vname' => 'LBL_CURRENT_STAGE_AT',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow',
  'relationship' => 'dri_workflow_current_stage_dri_subworkflows',
  'module' => 'DRI_Workflows',
);

$dictionary['DRI_SubWorkflow']['fields']['tasks'] = array (
  'name' => 'tasks',
  'vname' => 'LBL_TASKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Task',
  'relationship' => 'task_dri_subworkflows',
  'module' => 'Tasks',
);

$dictionary['DRI_SubWorkflow']['fields']['calls'] = array (
  'name' => 'calls',
  'vname' => 'LBL_CALLS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Call',
  'relationship' => 'call_dri_subworkflows',
  'module' => 'Calls',
);

$dictionary['DRI_SubWorkflow']['fields']['meetings'] = array (
  'name' => 'meetings',
  'vname' => 'LBL_MEETINGS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Meeting',
  'relationship' => 'meeting_dri_subworkflows',
  'module' => 'Meetings',
);

$dictionary['DRI_SubWorkflow']['fields']['date_started'] = array (
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

$dictionary['DRI_SubWorkflow']['fields']['date_completed'] = array (
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

$dictionary['DRI_SubWorkflow']['fields']['dri_subworkflow_template_id'] = array (
  'name' => 'dri_subworkflow_template_id',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_SubWorkflow']['fields']['dri_subworkflow_template_name'] = array (
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

$dictionary['DRI_SubWorkflow']['fields']['dri_subworkflow_template_link'] = array (
  'name' => 'dri_subworkflow_template_link',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_SubWorkflow_Template',
  'relationship' => 'dri_subworkflow_dri_subworkflow_templates',
  'module' => 'DRI_SubWorkflow_Templates',
);

$dictionary['DRI_SubWorkflow']['fields']['dri_workflow_id'] = array (
  'name' => 'dri_workflow_id',
  'vname' => 'LBL_DRI_WORKFLOW',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_SubWorkflow']['fields']['dri_workflow_name'] = array (
  'name' => 'dri_workflow_name',
  'vname' => 'LBL_DRI_WORKFLOW',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflows',
  'id_name' => 'dri_workflow_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflows',
  'link' => 'dri_workflow_link',
);

$dictionary['DRI_SubWorkflow']['fields']['dri_workflow_link'] = array (
  'name' => 'dri_workflow_link',
  'vname' => 'LBL_DRI_WORKFLOW',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow',
  'relationship' => 'dri_subworkflow_dri_workflows',
  'module' => 'DRI_Workflows',
);

$dictionary['DRI_SubWorkflow']['fields']['name']['len'] = 30;

$dictionary['DRI_SubWorkflow']['fields']['description']['full_text_search'] = array (
  'enabled' => false,
);

$dictionary['DRI_SubWorkflow']['relationships']['dri_subworkflow_dri_subworkflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_SubWorkflow_Templates',
  'lhs_table' => 'dri_subworkflow_templates',
  'rhs_module' => 'DRI_SubWorkflows',
  'rhs_table' => 'dri_subworkflows',
  'rhs_key' => 'dri_subworkflow_template_id',
);

$dictionary['DRI_SubWorkflow']['relationships']['dri_subworkflow_dri_workflows'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflows',
  'lhs_table' => 'dri_workflows',
  'rhs_module' => 'DRI_SubWorkflows',
  'rhs_table' => 'dri_subworkflows',
  'rhs_key' => 'dri_workflow_id',
);

$dictionary['DRI_SubWorkflow']['indices']['idx_cj_stage_org_tpl_id'] = array (
  'name' => 'idx_cj_stage_org_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_subworkflow_template_id',
  ),
);

$dictionary['DRI_SubWorkflow']['indices']['idx_cj_stage_parent_journey_id'] = array (
  'name' => 'idx_cj_stage_parent_journey_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_id',
  ),
);

$dictionary['DRI_SubWorkflow']['duplicate_check']['enabled'] = false;

$dictionary['DRI_SubWorkflow']['acls']['DotbACLCustomerJourney'] = true;
