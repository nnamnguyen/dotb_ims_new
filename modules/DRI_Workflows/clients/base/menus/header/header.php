<?php

$moduleName = 'DRI_Workflows';
$objectName = 'DRI_Workflow';

$viewdefs[$moduleName]['base']['menu']['header'] = array (
    array (
        'route' => '#' . $moduleName,
        'label' => 'LNK_VIEW_RECORDS',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-reorder icon-reorder',
    ),
    array (
        'label' => 'LNK_CONFIGURE',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-cog icon-cog',
        'route' => '#' . $moduleName . '/layout/configuration',
    ),
);
