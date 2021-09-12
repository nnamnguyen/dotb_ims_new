<?php


$module_name = 'pmse_Emails_Templates';
$viewdefs[$module_name] =
    array (
        'base' =>
            array (
                'view' =>
                    array (
                        'record' =>
                            array (
                                'buttons' => array(
                                    array(
                                        'type' => 'button',
                                                'name' => 'cancel_button',
                                                'label' => 'LBL_CANCEL_BUTTON_LABEL',
                                                'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
                                                'css_class' => 'btn ',
                                                'icon' => 'fa-window-close',
                                                'showOn' => 'edit',
                                        'events' => array(
                                            'click' => 'button:cancel_button:click',
                                        ),
                                    ),
                                    array(
                                        'type' => 'rowaction',
                                        'event' => 'button:save_button:click',
                                        'name' => 'save_button',
                                        'label' => 'LBL_SAVE_BUTTON_LABEL',
                                                'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
                                                'icon' => 'fa-save',

                                        'css_class' => 'btn btn-primary',
                                        'showOn' => 'edit',
                                        'acl_action' => 'edit',
                                    ),
                                    array(
                                        'type' => 'actiondropdown',
                                        'name' => 'main_dropdown',
                                        'primary' => true,
                                        'showOn' => 'view',
                                        'buttons' => array(
                                            array(
                                                'type' => 'rowaction',
                                                'event' => 'button:edit_emailstemplates:click',
                                                'name' => 'edit_button',
                                                'tooltip' => 'LBL_EDIT_BUTTON_LABEL',
                                                                'label' => 'LBL_EDIT_BUTTON_LABEL',
                                                                'icon' => 'fa-pencil',

                                                'acl_action' => 'edit',
                                            ),
                                            array(
                                                'type' => 'rowaction',
                                                'event' => 'button:design_emailtemplates:click',
                                                'name' => 'design_emailtemplates',
                                                'label' => 'LBL_PMSE_LABEL_DESIGN',
                                                'acl_action' => 'view',
                                            ),
                                            array(
                                                'type' => 'rowaction',
                                                'event' => 'button:export_emailtemplates:click',
                                                'name' => 'export_emailtemplates',
                                                'label' => 'LBL_PMSE_LABEL_EXPORT',
                                                'acl_action' => 'view',
                                            ),
                                            array(
                                                'type' => 'shareaction',
                                                'name' => 'share',
                                                'label' => 'LBL_RECORD_SHARE_BUTTON',
                                                'acl_action' => 'view',
                                            ),
                                            array(
                                                'type' => 'divider',
                                            ),
                                            array(
                                                'type' => 'rowaction',
                                                'event' => 'button:duplicate_button:click',
                                                'name' => 'duplicate_button',
                                                'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                                                'acl_module' => $module_name,
                                                'acl_action' => 'create',
                                            ),
                                            array(
                                                'type' => 'divider',
                                            ),
                                            array(
                                                'type' => 'rowaction',
                                                'event' => 'button:delete_emailstemplates:click',
                                                'name' => 'delete_button',
                                                'label' => 'LBL_DELETE_BUTTON_LABEL',
                                                'acl_action' => 'delete',
                                            ),
                                        ),
                                    ),
                                    array(
                                        'name' => 'sidebar_toggle',
                                        'type' => 'sidebartoggle',
                                    ),
                                ),
                                'panels' =>
                                    array (
                                        0 =>
                                            array (
                                                'name' => 'panel_header',
                                                'label' => 'LBL_RECORD_HEADER',
                                                'header' => true,
                                                'fields' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'name' => 'picture',
                                                                'type' => 'avatar',
                                                                'width' => 42,
                                                                'height' => 42,
                                                                'dismiss_label' => true,
                                                                'readonly' => true,
                                                            ),
                                                        1 => 'name',
                                                        2 =>
                                                            array (
                                                                'name' => 'favorite',
                                                                'label' => 'LBL_FAVORITE',
                                                                'type' => 'favorite',
                                                                'readonly' => true,
                                                                'dismiss_label' => true,
                                                            ),
                                                        3 =>
                                                            array (
                                                                'name' => 'follow',
                                                                'label' => 'LBL_FOLLOW',
                                                                'type' => 'follow',
                                                                'readonly' => true,
                                                                'dismiss_label' => true,
                                                            ),
                                                    ),
                                            ),
                                        1 =>
                                            array (
                                                'name' => 'panel_body',
                                                'label' => 'LBL_RECORD_BODY',
                                                'columns' => 2,
                                                'labelsOnTop' => true,
                                                'placeholders' => true,
                                                'newTab' => false,
                                                'panelDefault' => 'expanded',
                                                'fields' => array(
                                                    array(
                                                        'name' => 'base_module',
                                                        'studio' => 'visible',
                                                        'label' => 'LBL_BASE_MODULE',
                                                    ),
                                                    'assigned_user_name',
                                                ),
                                            ),
                                        2 =>
                                            array (
                                                'name' => 'panel_hidden',
                                                'label' => 'LBL_SHOW_MORE',
                                                'hide' => true,
                                                'columns' => 2,
                                                'labelsOnTop' => true,
                                                'placeholders' => true,
                                                'newTab' => false,
                                                'panelDefault' => 'expanded',
                                                'fields' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'name' => 'description',
                                                                'span' => 12,
                                                            ),
                                                        1 => 'date_modified',
                                                        2 => 'date_entered',
                                                        3 =>
                                                            array (
                                                                'name' => 'subject',
                                                                'readonly' => true,
                                                            ),
                                                        4 =>
                                                            array (
                                                                'name' => 'body_html',
                                                                'readonly' => true,
                                                            ),
                                                    ),
                                            ),
                                    ),
                                'templateMeta' =>
                                    array (
                                        'useTabs' => false,
                                    ),
                            ),
                    ),
            ),
    );