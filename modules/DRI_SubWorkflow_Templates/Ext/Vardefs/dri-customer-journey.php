<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/DRI_SubWorkflow_Templates/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['DRI_SubWorkflow_Template']['fields']['label'] = array (
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

$dictionary['DRI_SubWorkflow_Template']['fields']['sort_order'] = array (
  'name' => 'sort_order',
  'vname' => 'LBL_SORT_ORDER',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'int',
  'len' => 8,
  'options' => 'numeric_range_search_dom',
  'enable_range_search' => true,
);

$dictionary['DRI_SubWorkflow_Template']['fields']['points'] = array (
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

$dictionary['DRI_SubWorkflow_Template']['fields']['related_activities'] = array (
  'name' => 'related_activities',
  'vname' => 'LBL_RELATED_ACTIVITIES',
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

$dictionary['DRI_SubWorkflow_Template']['fields']['dri_subworkflows'] = array (
  'name' => 'dri_subworkflows',
  'vname' => 'LBL_DRI_SUBWORKFLOWS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_SubWorkflow',
  'relationship' => 'dri_subworkflow_dri_subworkflow_templates',
  'module' => 'DRI_SubWorkflows',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['dri_workflow_task_templates'] = array (
  'name' => 'dri_workflow_task_templates',
  'vname' => 'LBL_DRI_WORKFLOW_TASK_TEMPLATES',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'dri_workflow_task_template_dri_subworkflow_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['tasks'] = array (
  'name' => 'tasks',
  'vname' => 'LBL_TASKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Task',
  'relationship' => 'task_dri_subworkflow_templates',
  'module' => 'Tasks',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['meetings'] = array (
  'name' => 'meetings',
  'vname' => 'LBL_MEETINGS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Meeting',
  'relationship' => 'meeting_dri_subworkflow_templates',
  'module' => 'Meetings',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['calls'] = array (
  'name' => 'calls',
  'vname' => 'LBL_CALLS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Call',
  'relationship' => 'call_dri_subworkflow_templates',
  'module' => 'Calls',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['web_hooks'] = array (
  'name' => 'web_hooks',
  'vname' => 'LBL_WEB_HOOKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'CJ_WebHook',
  'relationship' => 'dri_subworkflow_templates_flex_relate_cj_web_hooks',
  'module' => 'CJ_WebHooks',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['dri_workflow_template_id'] = array (
  'name' => 'dri_workflow_template_id',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['dri_workflow_template_name'] = array (
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
  'link' => 'dri_workflow_template_link',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['dri_workflow_template_link'] = array (
  'name' => 'dri_workflow_template_link',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'dri_subworkflow_template_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['DRI_SubWorkflow_Template']['fields']['name']['len'] = 30;

$dictionary['DRI_SubWorkflow_Template']['fields']['description']['full_text_search'] = array (
  'enabled' => false,
);

$dictionary['DRI_SubWorkflow_Template']['relationships']['dri_subworkflow_templates_flex_relate_cj_web_hooks'] = array (
  'lhs_key' => 'id',
  'relationship_type' => 'one-to-many',
  'lhs_module' => 'DRI_SubWorkflow_Templates',
  'lhs_table' => 'dri_subworkflow_templates',
  'rhs_key' => 'parent_id',
  'rhs_module' => 'CJ_WebHooks',
  'rhs_table' => 'cj_web_hooks',
  'relationship_role_column_value' => 'DRI_SubWorkflow_Templates',
  'relationship_role_column' => 'parent_type',
);

$dictionary['DRI_SubWorkflow_Template']['relationships']['dri_subworkflow_template_dri_workflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_module' => 'DRI_SubWorkflow_Templates',
  'rhs_table' => 'dri_subworkflow_templates',
  'rhs_key' => 'dri_workflow_template_id',
);

$dictionary['DRI_SubWorkflow_Template']['indices']['idx_cj_stage_tpl_jry_tpl_id'] = array (
  'name' => 'idx_cj_stage_tpl_jry_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_template_id',
  ),
);

$dictionary['DRI_SubWorkflow_Template']['duplicate_check']['enabled'] = false;

$dictionary['DRI_SubWorkflow_Template']['acls']['DotbACLCustomerJourney'] = true;
