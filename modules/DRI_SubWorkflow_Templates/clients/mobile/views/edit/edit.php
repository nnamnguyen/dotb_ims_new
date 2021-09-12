<?php

$module_name = 'DRI_SubWorkflow_Templates';
$viewdefs[$module_name]['mobile']['view']['edit'] = array (
    'templateMeta' => array (
        'maxColumns' => '1',
        'widths' => array (
            array ('label' => '10', 'field' => '30'),
            array ('label' => '10', 'field' => '30')
        ),
    ),
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array (
                'name',
                'team_name',
            ),
        ),
    ),
);