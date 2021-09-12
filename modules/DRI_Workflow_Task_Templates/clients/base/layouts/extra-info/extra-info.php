<?php

$module = 'DRI_Workflow_Task_Templates';
$panel = array (
    'view' => 'dri-license-errors'
);

if (isset($viewdefs[$module]['base']['layout']['extra-info'])) {
    $viewdefs[$module]['base']['layout']['extra-info']['components'][] = $panel;
} else {
    $viewdefs[$module]['base']['layout']['extra-info'] = array(
        'components' => array ($panel),
        'type' => 'simple',
        'span' => 12,
    );
}
