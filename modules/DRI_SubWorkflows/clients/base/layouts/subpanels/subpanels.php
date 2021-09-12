<?php

$moduleName = 'DRI_SubWorkflows';
$objectName = 'DRI_SubWorkflow';

$viewdefs[$moduleName]['base']['layout']['subpanels'] = array (
    'components' => array (
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_DRI_WORKFLOWS',
            'context' => array(
                'link' => 'dri_workflows',
            ),
        ),
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_TASKS',
            'context' => array(
                'link' => 'tasks',
            ),
        ),
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_MEETINGS',
            'context' => array(
                'link' => 'meetings',
            ),
        ),
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_CALLS',
            'context' => array(
                'link' => 'calls',
            ),
        ),
    ),
    'type' => 'subpanels',
    'span' => 12,
);
