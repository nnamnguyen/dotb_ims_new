<?php

$viewdefs['KBContents']['base']['view']['subpanel-for-localizations'] = array(
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'event' => 'button:create_revision_button:click',
                'name' => 'create_revision_button',
                'label' => 'LBL_CREATE_REVISION_BUTTON_LABEL',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'language',
                    'label' => 'LBL_LANG',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                    'type' => 'enum-config',
                    'key' => 'languages',
                ),
                array(
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_entered',
                    'readonly' => true,
                ),
                array(
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_modified',
                    'readonly' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                    'enabled' => true,
                    'default' => true,
                    'type' => 'status',
                    'related_fields' => array(
                        'active_date',
                        'exp_date',
                    ),
                ),
            ),
        ),
    ),
);
