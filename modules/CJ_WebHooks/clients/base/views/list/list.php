<?php

$module_name = 'CJ_WebHooks';
$viewdefs[$module_name]['base']['view']['list'] = array (
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'label' => 'LBL_NAME',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'name',
                    'link' => true,
                ),
                array (
                    'name' => 'parent_name',
                    'label' => 'LBL_PARENT_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'trigger_event',
                    'label' => 'LBL_TRIGGER_EVENT',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'request_method',
                    'label' => 'LBL_REQUEST_METHOD',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'url',
                    'label' => 'LBL_URL',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'date_modified',
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
    'orderBy' => array (
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
