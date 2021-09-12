<?php

$viewdefs['ReportSchedules']['base']['view']['recordlist'] = array(
    'favorite' => true,
    'sticky_resizable_columns' => true,
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'edit_button',
                'type' => 'button',
                'label' => 'LBL_MASS_UPDATE',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massupdate:fire',
                ),
                'acl_action' => 'massupdate',
            ),
            array(
                'name' => 'massdelete_button',
                'type' => 'button',
                'label' => 'LBL_DELETE',
                'acl_action' => 'delete',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massdelete:fire',
                ),
            ),
        ),
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
                'name' => 'edit_button',


                'tooltip' => 'LBL_EDIT_BUTTON',
'label' => 'LBL_EDIT_BUTTON',
                'icon' => 'fa-pencil',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
                 'tooltip' => 'LBL_EDIT_BUTTON',
                'css_class' => 'btn',
                'dismiss_label' => true,
                'icon' => 'fa-pencil',
            ),

            array(
                'type' => 'rowaction',
                'name' => 'delete_button',

                'icon' => 'fa-trash-alt',
                'tooltip' => 'LBL_DELETE_BUTTON',
'label' => 'LBL_DELETE_BUTTON',


                'event' => 'list:deleterow:fire',
                'label' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
                'tooltip' => 'LBL_DELETE_BUTTON',
                'css_class' => 'btn',
                'dismiss_label' => true,
                'icon' => 'fa-trash-alt',
            ),
        ),
    ),
);
