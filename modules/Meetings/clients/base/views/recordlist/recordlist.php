<?php


$viewdefs['Meetings']['base']['view']['recordlist'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'massupdate_button',
                'type' => 'button',
                'label' => 'LBL_MASS_UPDATE',
                'acl_action' => 'massupdate',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massupdate:fire',
                ),
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
                'type' => 'launchbutton',
                'name' => 'host_button',
                'host' => true,
                'acl_action' => 'view',
            ),
            array(
                'type' => 'launchbutton',
                'name' => 'join_button',
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
                'type' => 'closebutton',
'icon' => 'fa-pause-circle',

                'name' => 'record-close',
                'label' => 'LBL_LIST_CLOSE',
                'closed_status' => 'Held',
                'acl_action' => 'edit',
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
            array(
                'type' => 'deleterecurrencesbutton',
                'name' => 'delete_recurrence_button',
                'label' => 'LBL_REMOVE_ALL_RECURRENCES',
                'acl_action' => 'delete',
            ),
        ),
    ),
);
