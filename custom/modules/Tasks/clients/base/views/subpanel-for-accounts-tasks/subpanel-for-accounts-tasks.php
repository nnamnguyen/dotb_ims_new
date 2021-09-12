<?php
// created: 2019-12-09 09:42:43
$viewdefs['Tasks']['base']['view']['subpanel-for-accounts-tasks'] = array (
        'panels' =>
        array (
            0 =>
            array (
                'name' => 'panel_header',
                'label' => 'LBL_PANEL_1',
                'fields' =>
                array (
                    0 =>
                    array (
                        'label' => 'LBL_LIST_SUBJECT',
                        'enabled' => true,
                        'default' => true,
                        'link' => true,
                        'name' => 'name',
                    ),
                    1 =>
                    array (
                        'name' => 'description',
                        'label' => 'LBL_DESCRIPTION',
                        'enabled' => true,
                        'sortable' => false,
                        'default' => true,
                        'width' => 'xxlarge',
                    ),
                    2 =>
                    array (
                        'label' => 'LBL_LIST_STATUS',
                        'enabled' => true,
                        'default' => true,
                        'name' => 'status',
                        'width' => 'small',
                        'type' => 'event-status',
                    ),
                    3 =>
                    array (
                        'name' => 'date_start',
                        'label' => 'LBL_LIST_START_DATE',
                        'css_class' => 'overflow-visible',
                        'enabled' => true,
                        'default' => true,
                    ),
                    4 =>
                    array (
                        'name' => 'date_due',
                        'label' => 'LBL_LIST_DUE_DATE',
                        'type' => 'datetimecombo-colorcoded',
                        'completed_status_value' => 'Completed',
                        'link' => false,
                        'css_class' => 'overflow-visible',
                        'enabled' => true,
                        'default' => true,
                    ),
                    5 =>
                    array (
                        'name' => 'assigned_user_name',
                        'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
                        'id' => 'ASSIGNED_USER_ID',
                        'enabled' => true,
                        'default' => true,
                    ),
                ),
            ),
        ),
        'rowactions' =>
        array (
            'actions' =>
            array (
                0 =>
                array (
                    'type' => 'rowaction',
                    'css_class' => 'btn',
                    'tooltip' => 'LBL_PREVIEW',
                    'event' => 'list:preview:fire',
                    'icon' => 'fa-search-plus',
                    'acl_action' => 'view',
                ),
                1 =>
      array (
        'type' => 'rowaction',
        'label' => 'LBL_EDIT_BUTTON',
        'event' => 'list:editrow:fire',
        'icon' => 'fa-pencil',
        'acl_action' => 'edit',
      ),
               2 =>
                array (
                    'type' => 'unlink-action',
                    'icon' => 'fa-unlink',
                    'label' => 'LBL_UNLINK_BUTTON',
                ),
                3 =>
                array (
                    'type' => 'closebutton',
                    'name' => 'record-close',
                    'label' => 'LBL_CLOSE_BUTTON_TITLE',
                    'closed_status' => 'Completed',
                    'acl_action' => 'edit',
                    'icon' => 'fa-times',
                ),
            ),
        ),
        'type' => 'subpanel-list',
);