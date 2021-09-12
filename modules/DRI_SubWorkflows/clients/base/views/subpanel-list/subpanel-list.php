<?php

$module_name = 'DRI_SubWorkflows';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array (
    'panels' => array (
        array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'label' => 'LBL_LABEL',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                    'name' => 'label',
                ),
                array (
                    'label' => 'LBL_SORT_ORDER',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'sort_order',
                    'type' => 'int',
                ),
                array (
                    'label' => 'LBL_STATE',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'state',
                    'type' => 'enum',
                ),
                array (
                    'label' => 'LBL_PROGRESS',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'progress',
                    'type' => 'cj_progress_bar',
                ),
                array (
                    'label' => 'LBL_MOMENTUM_RATIO',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'momentum_ratio',
                    'type' => 'cj_momentum_bar',
                ),
                array (
                    'label' => 'LBL_DATE_ENTERED',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'date_entered',
                    'type' => 'datetime',
                ),
                array (
                    'label' => 'LBL_DATE_MODIFIED',
                    'default' => true,
                    'enabled' => true,
                    'name' => 'date_modified',
                    'type' => 'datetime',
                ),
            ),
        ),
    ),
    'orderBy' => array (
        'field' => 'sort_order',
        'direction' => 'desc'
    ),
    'type' => 'subpanel-list'
);
