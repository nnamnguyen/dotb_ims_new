<?php

$module_name = 'DRI_Workflow_Template';
$table_name = 'dri_workflow_templates';
$popupMeta = array (
    'moduleMain' => $module_name,
    'varName' => $module_name,
    'orderBy' => 'name',
    'whereClauses' => array ('name' => $table_name . '.name'),
    'searchInputs' => array ('name'),
    'listviewdefs' => array(
        'NAME' => array(
            'width' => '40',
            'label' => 'LBL_NAME',
            'link' => true,
            'default' => true,
        ),
    ),
    'searchdefs'   => array(
        'name',
    ),
);
