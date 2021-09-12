<?php

$moduleName = 'DRI_Workflow_Templates';
$objectName = 'DRI_Workflow_Template';

$viewdefs[$moduleName]['base']['layout']['subpanels'] = array (
    'components' => array (
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
