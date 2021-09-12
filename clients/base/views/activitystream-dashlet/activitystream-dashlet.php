<?php


$viewdefs['base']['view']['activitystream-dashlet'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_ACTIVITY_STREAM_DASHLET_NAME',
            'description' => 'LBL_ACTIVITY_STREAM_DASHLET_DESCRIPTION',
            'config' => array(
                'module' => 'Activities',
                'limit' => 5,
            ),
            'preview' => array(
                'module' => 'Activities',
                'limit' => 5,
            ),
            'filter' => array(
                'view' => array(
                    'record',
                    'records'
                )
            )
        ),
    ),
    'custom_toolbar' => array(
        'buttons' => array(
            array(
                "type" => "dashletaction",
                "css_class" => "btn btn-invisible addComment",
                "icon" => "fa-plus",
                "action" => "addComment",
                'tooltip' => 'New comment',
            ),
            array(
                "type" => "dashletaction",
                "css_class" => "dashlet-toggle btn btn-invisible minify",
                "icon" => "fa-chevron-up",
                "action" => "toggleMinify",
                "tooltip" => "LBL_DASHLET_MINIMIZE",
            ),
            array(
                'dropdown_buttons' => array(
                    array(
                        'type' => 'dashletaction',
                        'action' => 'editClicked',
                        'label' => 'LBL_DASHLET_CONFIG_EDIT_LABEL',
                    ),
                    array(
                        'type' => 'dashletaction',
                        'action' => 'refreshClicked',
                        'label' => 'LBL_DASHLET_REFRESH_LABEL',
                    ),
                    array(
                        'type' => 'dashletaction',
                        'action' => 'toggleClicked',
                        'label' => 'LBL_DASHLET_MINIMIZE',
                        'event' => 'minimize',
                    ),
                    array(
                        'type' => 'dashletaction',
                        'action' => 'removeClicked',
                        'label' => 'LBL_DASHLET_REMOVE_LABEL',
                    ),
                ),
            ),
        ),
    ),
    'config' => array(
        'fields' => array(
            array(
                'name' => 'limit',
                'label' => 'LBL_DASHLET_CONFIGURE_DISPLAY_ROWS',
                'type' => 'enum',
                'options' => 'dashlet_limit_options',
            ),
            array(
                'name' => 'auto_refresh',
                'label' => 'LBL_REPORT_AUTO_REFRESH',
                'type' => 'enum',
                'options' => 'dotb7_dashlet_auto_refresh_options',
            ),
        ),
    ),
);
