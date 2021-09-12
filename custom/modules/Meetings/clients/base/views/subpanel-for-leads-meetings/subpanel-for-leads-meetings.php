<?php
    // created: 2020-01-07 02:00:37
    $viewdefs['Meetings']['base']['view']['subpanel-for-leads-meetings'] = array (
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
                        'name' => 'name',
                        'label' => 'LBL_LIST_SUBJECT',
                        'enabled' => true,
                        'default' => true,
                        'link' => true,
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
                        'name' => 'status',
                        'label' => 'LBL_LIST_STATUS',
                        'enabled' => true,
                        'default' => true,
                        'type' => 'event-status',
                        'css_class' => 'full-width',
                    ),
                    3 =>
                    array (
                        'name' => 'date_start',
                        'label' => 'LBL_LIST_DATE',
                        'type' => 'datetimecombo-colorcoded',
                        'completed_status_value' => 'Held',
                        'css_class' => 'overflow-visible',
                        'enabled' => true,
                        'default' => true,
                        'readonly' => true,
                        'related_fields' =>
                        array (
                            0 => 'status',
                        ),
                    ),
                    4 =>
                    array (
                        'name' => 'date_end',
                        'label' => 'LBL_CALENDAR_END_DATE',
                        'enabled' => true,
                        'readonly' => true,
                        'default' => true,
                    ),
                    5 =>
                    array (
                        'name' => 'assigned_user_name',
                        'target_record_key' => 'assigned_user_id',
                        'target_module' => 'Employees',
                        'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
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

                    'icon' => 'fa-chain-broken',
                    'label' => 'LBL_UNLINK_BUTTON',
                ),
                 3 =>
                array (
                    'type' => 'closebutton',
                    'icon' => 'fa-times-circle',
                    'name' => 'record-close',
                    'label' => 'LBL_CLOSE_BUTTON_TITLE',
                    'closed_status' => 'Held',
                    'acl_action' => 'edit',
                ),
            ),
        ),
        'type' => 'subpanel-list',
);