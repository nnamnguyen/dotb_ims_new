<?php

$moduleName = 'DRI_Workflow_Task_Templates';
$objectName = 'DRI_Workflow_Task_Template';

$viewdefs[$moduleName]['base']['layout']['subpanels'] = array (
    'components' => array (
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_CJ_FORMS_SUBPANEL_TITLE',
            'context' => array (
                'link' => 'forms',
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
