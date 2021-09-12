<?php


$module_name = 'pmse_Emails_Templates';
$viewdefs[$module_name ]['base']['view']['recordlist'] = array(
    'favorite' => true,
    'following' => false,
    'selection' => array(
    ),
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
                'name' => 'designer_button',
                'label' => 'LBL_PMSE_LABEL_DESIGN',
                'event' => 'list:editemailstemplates:fire',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
        'name' => 'edit_button',


        'tooltip' => 'LBL_EDIT_BUTTON',
'label' => 'LBL_EDIT_BUTTON',
        'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:edit_emailstemplates:fire',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'export_button',
                'label' => 'LBL_PMSE_LABEL_EXPORT',
                'event' => 'list:exportemailstemplates:fire',
                'acl_action' => 'view',
            ),



            array(
                'type' => 'rowaction',
                'name' => 'delete_button',

        'icon' => 'fa-trash-alt',
        'tooltip' => 'LBL_DELETE_BUTTON',
'label' => 'LBL_DELETE_BUTTON',

                'event' => 'list:deleteemailstemplates:fire',
                'label' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);
