<?php

$moduleName = 'DRI_SubWorkflows';
$objectName = 'DRI_SubWorkflow';

$viewdefs[$moduleName]['base']['menu']['header'] = array (
    array (
        'route' => '#' . $moduleName,
        'label' => 'LNK_VIEW_RECORDS',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-reorder icon-reorder',
    ),
);
