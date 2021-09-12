<?php

$viewdefs['Home']['base']['view']['search-dashboard-headerpane'] = array(
    'buttons' => array(
        array(
            'type' => 'actiondropdown',
            'buttons' => array(
                array(
                    'name'      => 'reset_button',
                    'type'      => 'rowaction',
                    'label'     => 'LBL_RESET_BUTTON_LABEL',
                    'css_class' => 'btn',
                ),

                array(
                    'name'      => 'collapse_button',
                    'type'      => 'rowaction',
                    'label'     => 'LBL_DASHLET_MINIMIZE_ALL',
                ),

                array(
                    'name'      => 'expand_button',
                    'type'      => 'rowaction',
                    'label'     => 'LBL_DASHLET_MAXIMIZE_ALL',
                ),
            ),
            'showOn' => 'view',
        ),
    ),
    'panels' => array(
        array(
            'name' => 'header',
            'fields' => array(
                array(
                    'type' => 'label',
                    'name' => 'name',
                    'default_value' => 'LBL_FACETS_DASHBOARD_TITLE',
                ),
            ),
        ),
    ),
);
