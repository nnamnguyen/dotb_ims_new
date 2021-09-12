<?php

$viewdefs['Tasks']['base']['view']['recordlist']['rowactions']['actions'] = array(
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
    ),
    array(
        'type' => 'follow',
        'name' => 'follow_button',
        'event' => 'list:follow:fire',
        'acl_action' => 'view',
    ),
    array(
        'type' => 'closebutton',
'icon' => 'fa-pause-circle',

        'name' => 'record-close',
        'label' => 'LBL_CLOSE_BUTTON_TITLE',
        'closed_status' => 'Completed',
        'acl_action' => 'edit',
    ),
    array(
        'type' => 'rowaction',

        'icon' => 'fa-trash-alt',
        'tooltip' => 'LBL_DELETE_BUTTON',
'label' => 'LBL_DELETE_BUTTON',

        'event' => 'list:deleterow:fire',
        'label' => 'LBL_DELETE_BUTTON',
        'acl_action' => 'delete',
    ),
);
