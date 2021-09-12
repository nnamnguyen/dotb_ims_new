<?php
$popupMeta = array (
    'moduleMain' => 'DRI_Workflow_Task_Templates',
    'varName' => 'DRI_Workflow_Task_Templates',
    'orderBy' => 'dri_workflow_task_templates.name',
    'whereClauses' => array (
  'name' => 'dri_workflow_task_templates.name',
  'dri_subworkflow_template_name' => 'dri_workflow_task_templates.dri_subworkflow_template_name',
  'sort_order' => 'dri_workflow_task_templates.sort_order',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'dri_subworkflow_template_name',
  5 => 'sort_order',
),
    'searchdefs' => array (
  'name' => 
  array (
    'type' => 'name',
    'label' => 'LBL_NAME',
    'width' => '10%',
    'name' => 'name',
  ),
  'dri_subworkflow_template_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
    'id' => 'DRI_SUBWORKFLOW_TEMPLATE_ID',
    'width' => '10%',
    'name' => 'dri_subworkflow_template_name',
  ),
  'sort_order' => 
  array (
    'type' => 'int',
    'label' => 'LBL_SORT_ORDER',
    'width' => '10%',
    'name' => 'sort_order',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'type' => 'name',
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
    'name' => 'name',
  ),
  'DRI_SUBWORKFLOW_TEMPLATE_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
    'id' => 'DRI_SUBWORKFLOW_TEMPLATE_ID',
    'width' => '10%',
    'default' => true,
    'name' => 'dri_subworkflow_template_name',
  ),
  'DRI_WORKFLOW_TEMPLATE_NAME' => 
  array (
    'type' => 'relate',
    'readonly' => true,
    'link' => true,
    'label' => 'LBL_DRI_WORKFLOW_TEMPLATE',
    'id' => 'DRI_WORKFLOW_TEMPLATE_ID',
    'width' => '10%',
    'default' => true,
  ),
  'SORT_ORDER' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_SORT_ORDER',
    'width' => '10%',
    'name' => 'sort_order',
  ),
  'ACTIVITY_TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'label' => 'LBL_ACTIVITY_TYPE',
    'width' => '10%',
    'name' => 'activity_type',
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'name' => 'type',
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
    'name' => 'date_modified',
  ),
),
);
