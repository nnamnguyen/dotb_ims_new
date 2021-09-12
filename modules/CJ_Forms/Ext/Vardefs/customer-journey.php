<?php

/**
 * Please note that this file has been generated based a file located on this path:
 * modules/CJ_Forms/vardefs.yml
 * and may be overwritten at a later point..
 */

$dictionary['CJ_Form']['fields']['trigger_event'] = array (
  'name' => 'trigger_event',
  'vname' => 'LBL_TRIGGER_EVENT',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'cj_forms_trigger_event_list',
  'type' => 'enum',
);

$dictionary['CJ_Form']['fields']['action_type'] = array (
  'name' => 'action_type',
  'vname' => 'LBL_ACTION_TYPE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'options' => 'cj_forms_action_type_list',
  'type' => 'enum',
);

$dictionary['CJ_Form']['fields']['relationship'] = array (
  'name' => 'relationship',
  'vname' => 'LBL_RELATIONSHIP',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'json',
  'dbType' => 'text',
);

$dictionary['CJ_Form']['fields']['activity_module'] = array (
  'name' => 'activity_module',
  'vname' => 'LBL_ACTIVITY_MODULE',
  'required' => true,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'varchar',
  'len' => 255,
  'enforced' => true,
  'calculated' => true,
  'formula' => 'related($activity_template_link, "activity_type")',
);

$dictionary['CJ_Form']['fields']['active'] = array (
  'name' => 'active',
  'vname' => 'LBL_ACTIVE',
  'required' => false,
  'reportable' => true,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'bool',
  'default' => true,
);

$dictionary['CJ_Form']['fields']['activity_template_id'] = array (
  'name' => 'activity_template_id',
  'vname' => 'LBL_ACTIVITY_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
);

$dictionary['CJ_Form']['fields']['activity_template_name'] = array (
  'name' => 'activity_template_name',
  'vname' => 'LBL_ACTIVITY_TEMPLATE',
  'required' => true,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'source' => 'non-db',
  'type' => 'relate',
  'rname' => 'name',
  'table' => 'dri_workflow_task_templates',
  'id_name' => 'activity_template_id',
  'sort_on' => 'name',
  'module' => 'DRI_Workflow_Task_Templates',
  'link' => 'activity_template_link',
);

$dictionary['CJ_Form']['fields']['activity_template_link'] = array (
  'name' => 'activity_template_link',
  'vname' => 'LBL_ACTIVITY_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Task_Template',
  'relationship' => 'cj_form_activity_template_dri_workflow_task_templates',
  'module' => 'DRI_Workflow_Task_Templates',
);

$dictionary['CJ_Form']['fields']['dri_workflow_template_id'] = array (
  'name' => 'dri_workflow_template_id',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'required' => false,
  'reportable' => false,
  'audited' => true,
  'importable' => 'true',
  'massupdate' => false,
  'type' => 'id',
  'enforced' => true,
  'calculated' => true,
  'formula' => 'related($activity_template_link, "dri_workflow_template_id")',
);

$dictionary['CJ_Form']['fields']['dri_workflow_template_name'] = array (
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

$dictionary['CJ_Form']['fields']['dri_workflow_template_link'] = array (
  'name' => 'dri_workflow_template_link',
  'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
  'source' => 'non-db',
  'type' => 'link',
  'side' => 'right',
  'bean_name' => 'DRI_Workflow_Template',
  'relationship' => 'cj_form_dri_workflow_templates',
  'module' => 'DRI_Workflow_Templates',
);

$dictionary['CJ_Form']['relationships']['cj_form_activity_template_dri_workflow_task_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Task_Templates',
  'lhs_table' => 'dri_workflow_task_templates',
  'rhs_module' => 'CJ_Forms',
  'rhs_table' => 'cj_forms',
  'rhs_key' => 'activity_template_id',
);

$dictionary['CJ_Form']['relationships']['cj_form_dri_workflow_templates'] = array (
  'relationship_type' => 'one-to-many',
  'lhs_key' => 'id',
  'lhs_module' => 'DRI_Workflow_Templates',
  'lhs_table' => 'dri_workflow_templates',
  'rhs_module' => 'CJ_Forms',
  'rhs_table' => 'cj_forms',
  'rhs_key' => 'dri_workflow_template_id',
);

$dictionary['CJ_Form']['indices']['idx_cj_forms_act_tpl_id'] = array (
  'name' => 'idx_cj_forms_act_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'activity_template_id',
  ),
);

$dictionary['CJ_Form']['indices']['idx_cj_forms_jry_tpl_id'] = array (
  'name' => 'idx_cj_forms_jry_tpl_id',
  'type' => 'index',
  'fields' => 
  array (
    0 => 'dri_workflow_template_id',
  ),
);

$dictionary['CJ_Form']['duplicate_check']['enabled'] = false;
