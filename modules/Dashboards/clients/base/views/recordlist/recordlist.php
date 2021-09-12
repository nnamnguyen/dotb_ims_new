<?php

$viewdefs['Dashboards']['base']['view']['recordlist'] = array(
    'favorite' => true,
    'following' => true,
    'sticky_resizable_columns' => true,
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
                'type' => 'customcopydashboard',
                'name' => 'copy_to_user',


                'tooltip' => 'LBL_COPY_TO_USER',
'label' => 'LBL_COPY_TO_USER',
                'icon' => 'fa-user',
                'target_module' => 'Users',
                'label' => 'LBL_COPY_TO_USER',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'customcopydashboard',
                'name' => 'copy_to_team',


                'tooltip' => 'LBL_COPY_TO_TEAM',
'label' => 'LBL_COPY_TO_TEAM',
                'icon' => 'fa-users',
                'target_module' => 'Teams',
                'label' => 'LBL_COPY_TO_TEAM',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'customcopydashboard',
                'name' => 'copy_to_role',


                'tooltip' => 'LBL_COPY_TO_ROLE',
'label' => 'LBL_COPY_TO_ROLE',
                'icon' => 'fa-balance-scale-right',
                'target_module' => 'ACLRoles',
                'label' => 'LBL_COPY_TO_ROLE',
                'acl_action' => 'edit',
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
    'last_state' => array(
        'id' => 'record-list',
    ),
);
