<?php

$module_name = 'DRI_Workflow_Templates';
$viewdefs[$module_name]['base']['layout']['detail'] = array (
    'type' => 'detail',
    'components' => array (
        array (
            'view' => 'subnavdetail',
        ),
        array (
            'view' => 'detail',
        ),
    ),
);