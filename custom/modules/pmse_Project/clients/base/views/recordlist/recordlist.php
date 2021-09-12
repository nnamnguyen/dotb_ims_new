<?php


$module_name = 'pmse_Project';
$viewdefs[$module_name]['base']['view']['recordlist'] = array(
    'favorite' => true,
    'following' => false,
    'selection' => array(),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'tooltip' => 'LBL_PMSE_LABEL_DESIGN',
                'label' => 'LBL_PMSE_LABEL_DESIGN',
                'icon' => 'fa-magic',
                'event' => 'list:opendesigner:fire',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'tooltip' => 'LBL_EDIT_BUTTON',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'icon' => 'fa-print',

                'tooltip' => 'LBL_PMSE_LABEL_EXPORT',
                'label' => 'LBL_PMSE_LABEL_EXPORT',
                'event' => 'list:exportprocess:fire',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'delete_button',
                'icon' => 'fa-trash-alt',
                'tooltip' => 'LBL_DELETE_BUTTON',
                'event' => 'list:deleterow:fire',
                'label' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
            ),
            array(
                'type' => 'enabled-disabled',
                'icon' => 'fa-times-circle',
                'event' => 'list:enabledDisabledRow:fire',
                'tooltip' => 'LBL_PMSE_LABEL_DISABLE',
                'label' => 'LBL_PMSE_LABEL_DISABLE',
                'acl_action' => 'delete',
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);
