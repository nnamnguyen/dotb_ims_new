<?php

$viewdefs['Quotes']['base']['view']['recordlist'] = array(
    'favorite' => true,
    'following' => true,
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
                'name' => 'calc_field_button',
                'type' => 'button',
                'label' => 'LBL_UPDATE_CALC_FIELDS',
                'events' => array(
                    'click' => 'list:updatecalcfields:fire',
                ),
                'acl_action' => 'massupdate',
            ),
            array(
                'name' => 'delete_button',
                'type' => 'button',
                'label' => 'LBL_DELETE',
                'acl_action' => 'delete',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massdelete:fire',
                ),
            ),
            array(
                'name' => 'export_button',
                'type' => 'button',
                'label' => 'LBL_EXPORT',
                'acl_action' => 'export',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massexport:fire',
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
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'follow',

                'tooltip' => 'LBL_FOLLOW',
'label' => 'LBL_FOLLOW',
                'icon' => 'fa-star-o',
                'event' => 'list:follow:fire',
                'acl_action' => 'view',
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
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);
