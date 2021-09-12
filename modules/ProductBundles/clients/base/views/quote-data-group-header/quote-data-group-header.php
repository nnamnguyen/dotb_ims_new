<?php

$viewdefs['ProductBundles']['base']['view']['quote-data-group-header'] = array(
    'buttons' => array(
        array(
            'type' => 'quote-data-actiondropdown',
            'name' => 'create-dropdown',
            'icon' => 'fa-plus',
            'no_default_action' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'css_class' => 'btn-invisible',
                    'icon' => 'fa-plus',
                    'name' => 'create_qli_button',
                    'label' => 'LBL_CREATE_QLI_BUTTON_LABEL',
                    'tooltip' => 'LBL_CREATE_QLI_BUTTON_TOOLTIP',
                    'acl_action' => 'create',
                ),
                array(
                    'type' => 'rowaction',
                    'css_class' => 'btn-invisible',
                    'icon' => 'fa-plus',
                    'name' => 'create_comment_button',
                    'label' => 'LBL_CREATE_COMMENT_BUTTON_LABEL',
                    'tooltip' => 'LBL_CREATE_COMMENT_BUTTON_TOOLTIP',
                    'acl_action' => 'create',
                ),
            ),
        ),
        array(
            'type' => 'quote-data-actiondropdown',
            'name' => 'edit-dropdown',
            'icon' => 'fa-ellipsis-v',
            'no_default_action' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'edit_bundle_button',
                    'label' => 'LBL_EDIT_BUTTON',
                    'tooltip' => 'LBL_EDIT_BUNDLE_BUTTON_TOOLTIP',
                    'acl_action' => 'edit',
                ),
                array(
                    'type' => 'rowaction',
                    'name' => 'delete_bundle_button',
                    'label' => 'LBL_DELETE_GROUP_BUTTON',
                    'tooltip' => 'LBL_DELETE_BUNDLE_BUTTON_TOOLTIP',
                    'acl_action' => 'delete',
                ),
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_quote_data_group_header',
            'label' => 'LBL_QUOTE_DATA_GROUP_HEADER',
            'fields' => array(
                array(
                    'name' => 'name',
                    'type' => 'quote-group-title',
                    'css_class' => 'group-name',
                ),
            ),
        ),
    ),
);
