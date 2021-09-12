<?php

$viewdefs['Calls']['base']['view']['recordlist'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'massupdate_button',
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
                'type' => 'completebutton',
                'icon' => 'fa-check-circle',

                'name' => 'record-close',
                'tooltip' => 'LBL_CHECK_COMPLETE_CALL',
'label' => 'LBL_CHECK_COMPLETE_CALL',

                'acl_action' => 'edit',
            ),
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
);
