<?php

$moduleName = 'DRI_SubWorkflow_Templates';
$objectName = 'DRI_SubWorkflow_Template';

$viewdefs[$moduleName]['base']['layout']['subpanels'] = array (
    'components' => array (
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_DRI_WORKFLOW_TASK_TEMPLATES_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'dri_workflow_task_templates',
            ),
        ),
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_CJ_WEBHOOKS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'web_hooks',
            ),
        ),
    ),
    'type' => 'subpanels',
    'span' => 12,
);
