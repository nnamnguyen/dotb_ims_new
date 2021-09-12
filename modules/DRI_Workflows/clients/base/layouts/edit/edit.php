<?php

$module_name = 'DRI_Workflows';
$viewdefs[$module_name]['base']['layout']['edit'] = array (
    'type' => 'edit',
    'components' => array (
        array (
            'view' => 'subnavedit',
        ),
        array (
            'view' => 'edit',
        )
    ),
);