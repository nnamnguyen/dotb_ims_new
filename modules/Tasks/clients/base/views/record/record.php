<?php
$viewdefs['Tasks'] =
    array(
        'base' =>
            array(
                'view' =>
                    array(
                        'record' =>
                            array(
                                'buttons' =>
                                    array(
                                        0 =>
                                            array(
                                                'type' => 'button',
                                                'name' => 'cancel_button',
                                                'label' => 'LBL_CANCEL_BUTTON_LABEL',
                                                'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
                                                'css_class' => 'btn ',
                                                'icon' => 'fa-window-close',
                                                'showOn' => 'edit',
                                                'events' =>
                                                    array(
                                                        'click' => 'button:cancel_button:click',
                                                    ),
                                            ),
                                        1 =>
                                            array(
                                                'type' => 'rowaction',
                                                'event' => 'button:save_button:click',
                                                'name' => 'save_button',
                                                'label' => 'LBL_SAVE_BUTTON_LABEL',
                                                'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
                                                'icon' => 'fa-save',
                                                
                                                'css_class' => 'btn btn-primary',
                                                'showOn' => 'edit',
                                                'acl_action' => 'edit',
                                            ),
                                        2 =>
                                            array(
                                                'type' => 'actiondropdown',
                                                'name' => 'main_dropdown',
                                                'primary' => true,
                                                'showOn' => 'view',
                                                'buttons' =>
                                                    array(
                                                        array(
                                                            'type' => 'rowaction',
                                                            'event' => 'button:edit_button:click',
                                                            'name' => 'edit_button',
                                                            'tooltip' => 'LBL_EDIT_BUTTON_LABEL',
                                                            'label' => 'LBL_EDIT_BUTTON_LABEL',
                                                            'icon' => 'fa-pencil',
                                                            
                                                            'primary' => true,
                                                            'acl_action' => 'edit',
                                                        ),
                                                        6 =>
                                                            array(
                                                                'type' => 'closebutton',
                                                                'name' => 'record-close',
                                                                'label' => 'LBL_COMPLETE_BUTTON_TITLE',
                                                                'closed_status' => 'Completed',
                                                                'acl_action' => 'edit',
                                                            ),
                                                        array(
                                                            'type' => 'rowaction',
                                                            'name' => 'duplicate_button',
                                                            'event' => 'button:duplicate_button:click',
                                                            'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                                                            'acl_module' => 'Tasks',
                                                            'acl_action' => 'create',
                                                        ),
//                                                        9 =>
                                                        array(
                                                            'type' => 'rowaction',
                                                            'event' => 'button:audit_button:click',
                                                            'name' => 'audit_button',
                                                            'label' => 'LNK_VIEW_CHANGE_LOG',
                                                            'acl_action' => 'view',
                                                        ),
                                                        array(
                                                            'type' => 'rowaction',
                                                            'event' => 'button:delete_button:click',
                                                            'name' => 'delete_button',
                                                            'label' => 'LBL_DELETE_BUTTON_LABEL',
                                                            'acl_action' => 'delete',
                                                        ),
                                                    ),
                                            ),
                                    ),
                                'panels' =>
                                    array(
                                        0 =>
                                            array(
                                                'name' => 'panel_header',
                                                'header' => true,
                                                'fields' =>
                                                    array(
                                                        array(
                                                            'name' => 'picture',
                                                            'type' => 'avatar',
                                                            'size' => 'large',
                                                            'dismiss_label' => true,
                                                            'readonly' => true,
                                                        ),
                                                        array(
                                                            'name' => 'name',
                                                        ),
                                                        array(
                                                            'name' => 'favorite',
                                                            'label' => 'LBL_FAVORITE',
                                                            'type' => 'favorite',
                                                            'dismiss_label' => true,
                                                        ),
                                                        array(
                                                            'name' => 'status',
                                                            'type' => 'event-status',
                                                            'enum_width' => 'auto',
                                                            'dropdown_width' => 'auto',
                                                            'dropdown_class' => 'select2-menu-only',
                                                            'container_class' => 'select2-menu-only',
                                                        ),
                                                    ),
                                            ),
                                        1 =>
                                            array(
                                                'name' => 'panel_body',
                                                'label' => 'LBL_RECORD_BODY',
                                                'columns' => 3,
                                                'labelsOnTop' => true,
                                                'placeholders' => true,
                                                'newTab' => false,
                                                'panelDefault' => 'expanded',
                                                'fields' =>
                                                    array(
                                                        array(
                                                            'name' => 'parent_name',
                                                            'requried' => true
                                                        ),
                                                        array(),
                                                        array(),
                                                        array(
                                                            'name' => 'date_start',
                                                            'type' => 'jdatetime'
                                                        ),
                                                        array(
                                                            'name' => 'task_duration'
                                                        ),
                                                        array(
                                                            'name' => 'date_due',
                                                            'type' => 'jdatetime'
                                                        ),
                                                        array(
                                                            'name' => 'priority'
                                                        ),
                                                        array(
                                                            'name' => 'remind_popup',
                                                            'label' => 'LBL_REMINDER_POPUP',
                                                        ),
                                                        array(
                                                            'name' => 'remind_email',
                                                            'label' => 'LBL_REMINDER_EMAIL',
                                                        ),

                                                        array(
                                                            'name' => 'description',
                                                            'span' => 8
                                                        ),
                                                        array(),
                                                        array(
                                                            'name' => 'dri_workflow_sort_order',
                                                            'label' => 'LBL_DRI_WORKFLOW_SORT_ORDER',
                                                        ),
                                                        array(
                                                            'name' => 'customer_journey_points',
                                                            'label' => 'LBL_CUSTOMER_JOURNEY_POINTS',
                                                        ),
                                                        array(
                                                            'name' => 'customer_journey_type',
                                                            'label' => 'LBL_CUSTOMER_JOURNEY_TYPE',
                                                        ),
                                                        array(
                                                            'name' => 'assigned_user_name',
                                                        ),
                                                        array(
                                                            'name' => 'date_entered_by',
                                                            'readonly' => true,
                                                            'inline' => true,
                                                            'type' => 'fieldset',
                                                            'label' => 'LBL_DATE_ENTERED',
                                                            'fields' =>
                                                                array(
                                                                    0 =>
                                                                        array(
                                                                            'name' => 'date_entered',
                                                                        ),
                                                                    1 =>
                                                                        array(
                                                                            'type' => 'label',
                                                                            'default_value' => 'LBL_BY',
                                                                        ),
                                                                    2 =>
                                                                        array(
                                                                            'name' => 'created_by_name',
                                                                        ),
                                                                ),
                                                        ),
                                                        array(),
                                                        'team_name',
                                                        array(
                                                            'name' => 'date_modified_by',
                                                            'readonly' => true,
                                                            'inline' => true,
                                                            'type' => 'fieldset',
                                                            'label' => 'LBL_DATE_MODIFIED',
                                                            'fields' =>
                                                                array(
                                                                    0 =>
                                                                        array(
                                                                            'name' => 'date_modified',
                                                                        ),
                                                                    1 =>
                                                                        array(
                                                                            'type' => 'label',
                                                                            'default_value' => 'LBL_BY',
                                                                        ),
                                                                    2 =>
                                                                        array(
                                                                            'name' => 'modified_by_name',
                                                                        ),
                                                                ),
                                                        ),
                                                        array(),
                                                    ),
                                            ),
                                    ),
                                'templateMeta' =>
                                    array(
                                        'useTabs' => false,
                                    ),
                            ),
                    ),
            ),
    );
