<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/DRI_Workflow_Templates/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['DRI_Workflow_Template']['fields']['available_modules'] = array (
  'name' => 'available_modules',
  'vname' => 'LBL_AVAILABLE_MODULES',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_available_modules_list',
  'type' => 'multienum',
  'isMultiSelect' => true,
);

$dictionary['DRI_Workflow_Template']['fields']['disabled_stage_actions'] = array (
  'name' => 'disabled_stage_actions',
  'vname' => 'LBL_DISABLED_STAGE_ACTIONS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_disabled_stage_actions_list',
  'type' => 'multienum',
  'isMultiSelect' => true,
);

$dictionary['DRI_Workflow_Template']['fields']['disabled_activity_actions'] = array (
  'name' => 'disabled_activity_actions',
  'vname' => 'LBL_DISABLED_ACTIVITY_ACTIONS',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'dri_workflow_templates_disabled_activity_actions_list',
  'type' => 'multienum',
  'isMultiSelect' => true,
);

$dictionary['DRI_Workflow_Template']['fields']['dri_workflows'] = array (
  'name' => 'dri_workflows',
  'vname' => 'LBL_DRI_WORKFLOWS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow',
  'relationship' => 'dri_workflow_dri_workflow_templates',
  'module' => 'DRI_Workflows',
);

$dictionary['DRI_Workflow_Template']['fields']['dri_subworkflow_templates'] = array (
  'name' => 'dri_subworkflow_templates',
  'vname' => 'LBL_DRI_SUBWORKFLOW_TEMPLATES',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_SubWorkflow_Template',
  'relationship' => 'dri_subworkflow_template_dri_workflow_templates',
  'module' => 'DRI_SubWorkflow_Templates',
);

$dictionary['DRI_Workflow_Template']['fields']['dri_workflow_task_templates'] = array (
  'name' => 'dri_workflow_task_templates',
  'vname' => 'LBL_DRI_WORKFLOW_TASK_TEMPLATES',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'dri_workflow_task_template_dri_workflow_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['DRI_Workflow_Template']['fields']['forms'] = array (
  'name' => 'forms',
  'vname' => 'LBL_FORMS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'CJ_Form',
  'relationship' => 'cj_form_dri_workflow_templates',
  'module' => 'CJ_Forms',
);

$dictionary['DRI_Workflow_Template']['fields']['copies'] = array (
  'name' => 'copies',
  'vname' => 'LBL_COPIES',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'dri_workflow_template_copied_template_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['DRI_Workflow_Template']['fields']['tasks'] = array (
  'name' => 'tasks',
  'vname' => 'LBL_TASKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Task',
  'relationship' => 'task_dri_workflow_templates',
  'module' => 'Tasks',
);

$dictionary['DRI_Workflow_Template']['fields']['meetings'] = array (
  'name' => 'meetings',
  'vname' => 'LBL_MEETINGS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Meeting',
  'relationship' => 'meeting_dri_workflow_templates',
  'module' => 'Meetings',
);

$dictionary['DRI_Workflow_Template']['fields']['calls'] = array (
  'name' => 'calls',
  'vname' => 'LBL_CALLS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Call',
  'relationship' => 'call_dri_workflow_templates',
  'module' => 'Calls',
);

$dictionary['DRI_Workflow_Template']['fields']['accounts'] = array (
  'name' => 'accounts',
  'vname' => 'LBL_ACCOUNTS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Account',
  'relationship' => 'account_dri_workflow_templates',
  'module' => 'Accounts',
);

$dictionary['DRI_Workflow_Template']['fields']['contacts'] = array (
  'name' => 'contacts',
  'vname' => 'LBL_CONTACTS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Contact',
  'relationship' => 'contact_dri_workflow_templates',
  'module' => 'Contacts',
);

$dictionary['DRI_Workflow_Template']['fields']['leads'] = array (
  'name' => 'leads',
  'vname' => 'LBL_LEADS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Lead',
  'relationship' => 'lead_dri_workflow_templates',
  'module' => 'Leads',
);

$dictionary['DRI_Workflow_Template']['fields']['cases'] = array (
  'name' => 'cases',
  'vname' => 'LBL_CASES',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'aCase',
  'relationship' => 'case_dri_workflow_templates',
  'module' => 'Cases',
);

$dictionary['DRI_Workflow_Template']['fields']['opportunities'] = array (
  'name' => 'opportunities',
  'vname' => 'LBL_OPPORTUNITIES',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'Opportunity',
  'relationship' => 'opportunity_dri_workflow_templates',
  'module' => 'Opportunities',
);

$dictionary['DRI_Workflow_Template']['fields']['points'] = array (
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

$dictionary['DRI_Workflow_Template']['fields']['related_activities'] = array (
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

$dictionary['DRI_Workflow_Template']['fields']['active'] = array (
  'name' => 'active',
  'vname' => 'LBL_ACTIVE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => true,
  'type' => 'bool',
  'default' => true,
);

$dictionary['DRI_Workflow_Template']['fields']['assignee_rule'] = array (
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

$dictionary['DRI_Workflow_Template']['fields']['target_assignee'] = array (
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

$dictionary['DRI_Workflow_Template']['fields']['web_hooks'] = array (
  'name' => 'web_hooks',
  'vname' => 'LBL_WEB_HOOKS',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'left',
  'bean_name' => 'CJ_WebHook',
  'relationship' => 'dri_workflow_templates_flex_relate_cj_web_hooks',
  'module' => 'CJ_WebHooks',
);

$dictionary['DRI_Workflow_Template']['fields']['copied_template_id'] = array (
  'name' => 'copied_template_id',
  'vname' => 'LBL_COPIED_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['DRI_Workflow_Template']['fields']['copied_template_name'] = array (
  'name' => 'copied_template_name',
  'vname' => 'LBL_COPIED_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflow_templates',
  'id_name' => 'copied_template_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflow_Templates',
  'dependency' => 'not(equal($copied_template_name, ""))',
  'link' => 'copied_template_link',
);

$dictionary['DRI_Workflow_Template']['fields']['copied_template_link'] = array (
  'name' => 'copied_template_link',
  'vname' => 'LBL_COPIED_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'dri_workflow_template_copied_template_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['DRI_Workflow_Template']['fields']['description']['full_text_search'] = array (
  'enabled' => false,
);

$dictionary['DRI_Workflow_Template']['relationships']['dri_workflow_templates_flex_relate_cj_web_hooks'] = array (
  'lhs_key' => 'id',
  'relationship_type' => 'one-to-many',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_key' => 'parent_id',
  'rhs_module' => 'CJ_WebHooks',
  'rhs_table' => 'cj_web_hooks',
  'relationship_role_column_value' => 'DRI_Workflow_Templates',
  'relationship_role_column' => 'parent_type',
);

$dictionary['DRI_Workflow_Template']['relationships']['dri_workflow_template_copied_template_dri_workflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_module' => 'DRI_Workflow_Templates',
  'rhs_table' => 'dri_workflow_templates',
  'rhs_key' => 'copied_template_id',
);

$dictionary['DRI_Workflow_Template']['indices']['idx_cj_jry_tpl_copied_tpl_id'] = array (
  'name' => 'idx_cj_jry_tpl_copied_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'copied_template_id',
  ),
);

$dictionary['DRI_Workflow_Template']['duplicate_check']['enabled'] = false;

$dictionary['DRI_Workflow_Template']['acls']['DotbACLCustomerJourney'] = true;
