<?php

$viewdefs['OutboundEmail']['base']['view']['recordlist'] = array(
    'favorite' => false,
    'following' => false,
    'sticky_resizable_columns' => false,
    'selection' => array(),
    'rowactions' => array(
        'actions' => array(
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
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',


                'icon' => 'fa-pencil',
                'tooltip' => 'LBL_EDIT_BUTTON',
'label' => 'LBL_EDIT_BUTTON',
                'acl_action' => 'edit',
                'route' => array(
                    'action' => 'edit',
                    'module' => 'OutboundEmail',
                ),
            ),

        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);
