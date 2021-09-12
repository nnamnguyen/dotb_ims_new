<?php

if (!isset($module_name)) {
    $module_name = 'null';
}

$panel = array (
    'layout' => 'dri-workflows',
    'label' => 'LBL_DRI_WORKFLOWS',
    'context' => array (
        'link' => 'dri_workflows',
    ),
);

if (isset($viewdefs[$module_name]['base']['layout']['extra-info'])) {
    $viewdefs[$module_name]['base']['layout']['extra-info']['components'][] = $panel;
} else {
    $viewdefs[$module_name]['base']['layout']['extra-info'] = array(
        'components' => array ($panel),
        'type' => 'simple',
        'span' => 12,
    );
}
