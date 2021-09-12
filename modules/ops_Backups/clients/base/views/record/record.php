<?php
$module_name = 'ops_Backups';
$viewdefs[$module_name]['base']['view']['record'] = array (
    'buttons' => array(
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
    'panels' => array (
        array (
            'name' => 'panel_header',
            'label' => 'LBL_RECORD_HEADER',
            'header' => true,
            'fields' => array (
                array (
                    'name' => 'picture',
                    'type' => 'avatar',
                    'width' => 42,
                    'height' => 42,
                    'dismiss_label' => true,
                    'readonly' => true,
                ),
                'name',
                'download_link'
            ),
        ),
        array (
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'newTab' => false,
            'panelDefault' => 'expanded',
            'fields' => array (
                array(
                    'name' => 'date_entered'
                ),
                array(
                    'name' => 'expires_at'
                ),
                array (
                    'name' => 'description',
                    'span' => 12,
                ),
            ),
        ),
    ),
    'templateMeta' => array (
          'useTabs' => false,
    ),
);
