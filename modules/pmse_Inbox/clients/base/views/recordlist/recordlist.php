<?php


$viewdefs['pmse_Inbox']['base']['view']['recordlist'] = array(
    'favorite' => false,
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
        'name' => 'edit_button',


        'tooltip' => 'LBL_EDIT_BUTTON',
'label' => 'LBL_EDIT_BUTTON',
        'icon' => 'fa-pencil',
                'label' => 'LBL_PMSE_SHOW_PROCESS',
                'event' => 'list:process:fire',
                'acl_action' => 'view',
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);
