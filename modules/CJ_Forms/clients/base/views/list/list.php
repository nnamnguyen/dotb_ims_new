<?php

$module_name = 'CJ_Forms';
$viewdefs[$module_name]['base']['view']['list'] = array (
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array (
                    'name' => 'trigger_event',
                    'label' => 'LBL_TRIGGER_EVENT',
                    'default' => true,
                    'enabled' => true,
                ),
                array (
                    'name' => 'action_type',
                    'label' => 'LBL_ACTION_TYPE',
                    'default' => true,
                    'enabled' => true,
                ),
                array (
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_modified',
                    'readonly' => true,
                ),
                array (
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_entered',
                    'readonly' => true,
                ),
            ),
        ),
    ),
    'orderBy' => array (
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
