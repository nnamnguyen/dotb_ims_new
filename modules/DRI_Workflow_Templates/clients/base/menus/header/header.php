<?php

$moduleName = 'DRI_Workflow_Templates';
$objectName = 'DRI_Workflow_Template';

$viewdefs[$moduleName]['base']['menu']['header'] = array (
    array (
        'label' => 'LNK_NEW_RECORD',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus icon-plus',
        'route' => '#' . $moduleName . '/create',
    ),
    array (
        'route' => '#' . $moduleName,
        'label' => 'LNK_VIEW_RECORDS',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-reorder icon-reorder',
    ),
    array(
        'route'=>'#'.$moduleName.'/layout/template-import',
        'label' =>'LNK_IMPORT_CUSTOMER_JOURNEY_TEMPLATES',
        'acl_action' => 'import',
        'acl_module' => $moduleName,
        'icon' => 'fa-arrow-circle-o-up',
    ),
);
