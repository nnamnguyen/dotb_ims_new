<?php

$module_name = 'CJ_Forms';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array (
    'panels' =>
        array (
            array (
                'name' => 'panel_header',
                'label' => 'LBL_PANEL_1',
                'fields' =>
                    array (
                        array (
                            'label' => 'LBL_NAME',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'name',
                            'link' => true,
                        ),
                        array (
                            'name' => 'active',
                            'label' => 'LBL_ACTIVE',
                            'enabled' => true,
                            'default' => true,
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
                        ),
                    ),
            ),
        ),
    'orderBy' => array (
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
