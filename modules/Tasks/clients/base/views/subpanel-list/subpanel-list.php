<?php

$viewdefs['Tasks']['base']['view']['subpanel-list'] = array(
    'panels' =>
        array(
            array(
                'name' => 'panel_header',
                'label' => 'LBL_PANEL_1',
                'fields' =>
                    array(
                        array(
                            'label' => 'LBL_LIST_SUBJECT',
                            'enabled' => true,
                            'default' => true,
                            'link' => true,
                            'name' => 'name',
                        ),
                        array(
                            'label' => 'LBL_LIST_STATUS',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'status',
                        ),
                        array(
                            'target_record_key' => 'contact_id',
                            'target_module' => 'Contacts',
                            'label' => 'LBL_LIST_CONTACT',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'contact_name',
                        ),
                        array(
                            'name' => 'date_start',
                            'label' => 'LBL_LIST_START_DATE',
                            'css_class' => 'overflow-visible',
                            'enabled' => true,
                            'default' => true,
                        ),
                        array(
                            'name' => 'date_due',
                            'label' => 'LBL_LIST_DUE_DATE',
                            'type' => 'datetimecombo-colorcoded',
                            'completed_status_value' => 'Completed',
                            'link' => false,
                            'css_class' => 'overflow-visible',
                            'enabled' => true,
                            'default' => true,
                        ),
                        array(
                            'name' => 'assigned_user_name',
                            'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
                            'id' => 'ASSIGNED_USER_ID',
                            'enabled' => true,
                            'default' => true,
                        ),
                    ),
            ),
        ),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire','css_class'=>'btn',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'unlink-action',
                'icon' => 'fa-unlink',
                'tooltip' => 'LBL_UNLINK_BUTTON', 'css_class'=>'btn',
                'css_class' => 'btn',
            ),
            array(
                'type' => 'closebutton',
                'name' => 'record-close',
                'dismiss_label' => true,
                'tooltip' => 'LBL_CLOSE_BUTTON_TITLE',
                'closed_status' => 'Completed',
                'acl_action' => 'edit',
                'css_class' => 'btn',
                'icon' => 'fa-times',
            ),
        ),
    ),
);
