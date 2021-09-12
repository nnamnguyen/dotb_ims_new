<?php
    $viewdefs['Calls'] =
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
                            'type' => 'actiondropdown',
                            'name' => 'save_dropdown',
                            'primary' => true,
                            'switch_on_click' => true,
                            'showOn' => 'edit',
                            'buttons' =>
                            array(
                                0 =>
                                array(
                                    'type' => 'rowaction',
                                    'event' => 'button:save_button:click',
                                    'name' => 'save_button',
                                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                                    'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
                                    'icon' => 'fa-save',
                                    
                                    'css_class' => 'btn btn-primary',
                                    'acl_action' => 'edit',
                                ),
                            ),
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
                                    
                                    'acl_action' => 'edit',
                                ),
                                array(
                                    'type' => 'rowaction',
                                    'event' => 'button:duplicate_button:click',
                                    'name' => 'duplicate_button',
                                    'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                                    'acl_module' => 'Calls',
                                    'acl_action' => 'create',
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
                        3 =>
                        array(
                            'name' => 'sidebar_toggle',
                            'type' => 'sidebartoggle',
                        ),
                    ),
                    'panels' => array(
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
                                    'name' => 'name'
                                ),
                                array(
                                    'name' => 'favorite',
                                    'label' => 'LBL_FAVORITE',
                                    'type' => 'favorite',
                                    'readonly' => true,
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
                        array(
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                            'name' => 'LBL_RECORDVIEW_PANEL1',
                            'label' => 'LBL_RECORDVIEW_PANEL1',
                            'columns' => 3,
                            'labelsOnTop' => 1,
                            'placeholders' => 1,
                            'fields' => array(
                                array(
                                    'name' => 'parent_name',
                                    'required' => true
                                ),
                                array(
                                    'name' => 'date_start',
                                    'type' => 'jdatetime',
                                    'readonly' => false,
                                    'default' => 'now',
                                    'required' => true
                                ),
                                array(
                                    'name' => 'date_end',
                                    'readonly' => false,
                                    'type' => 'jdatetime',
                                    'label' => 'LBL_DATE_END',
                                ),
                                array(
                                    'name' => 'direction',
                                ),
                                array(
                                    'name' => 'call_duration',
                                ),
                                array(
                                    'name'=>'call_purpose'
                                ),
                                array(
                                    'name' => 'recall',
                                ),
                                array(
                                    'name' => 'recall_at',
                                    'type' => 'jdatetime',
                                ),
                                array(
                                    'name' => 'call_result',
                                ),
                                array(
                                    'name' => 'reminder_time'
                                ),
                                array(
                                    'name' => 'email_reminder_time'
                                ),
                                array(
                                    'name' => 'mark_favorite'
                                ),
                                array(
                                    'name' => 'description',
                                    'rows'=>3,
                                    'span'=>8
                                ),
                                array(
                                    'name' => 'move_trash'
                                ),
                            ),
                        ),
                        array(
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                            'name' => 'LBL_RECORDVIEW_PANEL3',
                            'label' => 'LBL_RECORDVIEW_PANEL3',
                            'columns' => 3,
                            'labelsOnTop' => 1,
                            'placeholders' => 1,
                            'fields' =>
                            array(
                                array(
                                    'name' => 'call_entrysource',
                                    'readonly' => true
                                ),
                                array(
                                    'name' => 'call_recording',
                                    'readonly' => true,
                                    'type'=>'audio'
                                ),
                                array(),
                                array(
                                    'name' => 'call_source',
                                    'label' => 'LBL_CALL_SOURCE',
                                    'readonly' => true
                                ),
                                array(
                                    'name' => 'call_destination',
                                    'label' => 'LBL_CALL_DESTINATION',
                                    'readonly' => true
                                ),

                                array()
                            ),
                        ),

                        array(
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                            'name' => 'LBL_RECORDVIEW_PANEL4',
                            'label' => 'LBL_RECORDVIEW_PANEL4',
                            'columns' => 3,
                            'labelsOnTop' => 1,
                            'placeholders' => 1,
                            'fields' =>
                            array(
                                'assigned_user_name',
                                'team_name',
                                array(),
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
                                array()
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
