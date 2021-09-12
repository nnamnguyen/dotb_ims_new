<?php

$module_name = 'DRI_SubWorkflow_Templates';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array (
    'panels' => array (
        array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'label' => 'LBL_LABEL',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                    'name' => 'label',
                ),
                array (
                    'name' => 'sort_order',
                    'label' => 'LBL_SORT_ORDER',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'related_activities',
                    'label' => 'LBL_RELATED_ACTIVITIES',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'points',
                    'label' => 'LBL_POINTS',
                    'enabled' => true,
                    'default' => true,
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
        'field' => 'sort_order',
        'direction' => 'asc',
    ),
);
