<?php

if (!isset($module)) {
    $module = 'null';
}

if (!isset($table_name)) {
    $table_name = 'null';
}

if (!isset($object_name)) {
    $object_name = 'null';
}

$vardefs['fields']['dri_workflows'] = array (
    'name' => 'dri_workflows',
    'vname' => 'LBL_DRI_WORKFLOWS',
    'source' => 'non-db',
    'type' => 'link',
    'side' => 'left',
    'bean_name' => 'DRI_Workflow',
    'relationship' => 'dri_workflow_'.strtolower($module),
    'module' => 'DRI_Workflows',
);

$vardefs['fields']['dri_workflow_template_id'] = array (
    'name' => 'dri_workflow_template_id',
    'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
    'required' => false,
    'reportable' => false,
    'audited' => true,
    'importable' => 'true',
    'massupdate' => true,
    'type' => 'enum',
    'dbType' => 'id',
    'processes' => true,
    'studio' => false,
    'function' => array (
        'include' => "custom/modules/$module/CustomerJourney/EnumManager.php",
        'name' => array (
            "\\$module\\CustomerJourney\\EnumManager",
            'listEnumValues',
        ),
    ),
);

$vardefs['fields']['dri_workflow_template_name'] = array (
    'name' => 'dri_workflow_template_name',
    'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
    'required' => false,
    'reportable' => false,
    'audited' => true,
    'importable' => 'true',
    'massupdate' => false,
    'studio' => false,
    'source' => 'non-db',
    'type' => 'relate',
    'rname' => 'name',
    'table' => 'dri_workflow_templates',
    'id_name' => 'dri_workflow_template_id',
    'sort_on' => 'name',
    'module' => 'DRI_Workflow_Templates',
    'link' => 'dri_workflow_template_link',
);

$vardefs['fields']['dri_workflow_template_link'] = array (
    'name' => 'dri_workflow_template_link',
    'vname' => 'LBL_DRI_WORKFLOW_TEMPLATE',
    'reportable' => false,
    'source' => 'non-db',
    'type' => 'link',
    'side' => 'right',
    'bean_name' => 'DRI_Workflow_Template',
    'relationship' => strtolower($object_name).'_dri_workflow_templates',
    'module' => 'DRI_Workflow_Templates',
);

$vardefs['relationships'][strtolower($object_name).'_dri_workflow_templates'] = array (
    'relationship_type' => 'one-to-many',
    'lhs_key' => 'id',
    'lhs_module' => 'DRI_Workflow_Templates',
    'lhs_table' => 'dri_workflow_templates',
    'rhs_module' => $module,
    'rhs_table' => strtolower($module),
    'rhs_key' => 'dri_workflow_template_id',
);

$vardefs['indices']['idx_'.trim(substr(strtolower($table_name), 0, 17)).'_cjtpl_id'] = array (
    'name' => 'idx_'.trim(substr(strtolower($table_name), 0, 17)).'_cjtpl_id',
    'type' => 'index',
    'fields' => array ('dri_workflow_template_id'),
);
