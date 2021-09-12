<?php

$viewdefs['base']['view']['dri-workflows-header'] = array (
    'fields' => array (
        array (
            'name' => 'dri_workflow_template_id',
        ),
    ),
    'buttons' => array (
        array (
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'buttons' => array (
                array (
                    'type' => 'rowaction',
                    'icon' => 'fa-plus icon-plus',
                    'name' => 'start_cycle',
                    'event' => 'parent:start_cycle:click',
                    'tooltip' => 'LBL_START_CYCLE_BUTTON_TITLE',
                    'acl_action' => 'edit',
                    'acl_module' => 'DRI_Workflows',
                    'label' => ' ',
                ),
            ),
        ),
    ),
    'last_state' => array (
        'id' => 'dri-workflows-header',
        'defaults' => array (
            'show_more' => 'less',
        ),
    ),
);
