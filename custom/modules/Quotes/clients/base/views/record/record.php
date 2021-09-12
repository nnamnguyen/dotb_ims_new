<?php
$viewdefs['Quotes'] =
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
                                0 =>
                                array(
                                    'type' => 'rowaction',
                                    'event' => 'button:edit_button:click',
                                    'name' => 'edit_button',
                                    'tooltip' => 'LBL_EDIT_BUTTON_LABEL',
                                    'label' => 'LBL_EDIT_BUTTON_LABEL',
                                    'icon' => 'fa-pencil',
                                    'acl_action' => 'edit',
                                ),
                                1 =>
                                array(
                                    'type' => 'shareaction',
                                    'name' => 'share',
                                    'label' => 'LBL_RECORD_SHARE_BUTTON',
                                    'acl_action' => 'view',
                                ),
                                2 =>
                                array(
                                    'type' => 'pdfaction2',
                                    'name' => 'download-pdf-quote',
                                    'label' => 'LBL_DOWNLOAD_QUOTE',
                                    'acl_action' => 'view',
                                    'download_type' => 'quote'
                                ),
                                3 =>
                                array(
                                    'type' => 'pdfaction2',
                                    'name' => 'download-pdf-invoice',
                                    'label' => 'LBL_DOWNLOAD_INVOICE',
                                    'acl_action' => 'view',
                                    'download_type' => 'invoice'
                                ),
                                4 =>
                                array(
                                    'type' => 'rowaction',
                                    'event' => 'button:duplicate_button:click',
                                    'name' => 'duplicate_button',
                                    'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                                    'acl_module' => 'Quotes',
                                    'acl_action' => 'create',
                                ),
                                5 =>
                                array(
                                    'type' => 'rowaction',
                                    'event' => 'button:audit_button:click',
                                    'name' => 'audit_button',
                                    'label' => 'LNK_VIEW_CHANGE_LOG',
                                    'acl_action' => 'view',
                                ),
                                6 =>
                                array(
                                    'type' => 'divider',
                                ),
                                7 =>
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
                    'panels' =>
                    array(
                        0 =>
                        array(
                            'name' => 'panel_header',
                            'label' => 'LBL_PANEL_HEADER',
                            'header' => true,
                            'fields' =>
                            array(
                                0 =>
                                array(
                                    'name' => 'picture',
                                    'type' => 'avatar',
                                    'size' => 'large',
                                    'dismiss_label' => true,
                                    'readonly' => true,
                                ),
                                1 =>
                                array(
                                    'name' => 'name',
                                    'readonly' => true,
                                    'placeholder' => '---auto generate---',
                                    'required' => false,
                                    'events' =>
                                    array(
                                        'keyup' => 'update:quote',
                                    ),
                                    'related_fields' =>
                                    array(
                                        0 =>
                                        array(
                                            'name' => 'bundles',
                                            'fields' =>
                                            array(
                                                0 => 'id',
                                                1 => 'bundle_stage',
                                                2 => 'currency_id',
                                                3 => 'base_rate',
                                                4 => 'currencies',
                                                5 => 'name',
                                                6 => 'deal_tot',
                                                7 => 'deal_tot_usdollar',
                                                8 => 'deal_tot_discount_percentage',
                                                9 => 'new_sub',
                                                10 => 'new_sub_usdollar',
                                                11 => 'position',
                                                12 => 'related_records',
                                                13 => 'shipping',
                                                14 => 'shipping_usdollar',
                                                15 => 'subtotal',
                                                16 => 'subtotal_usdollar',
                                                17 => 'tax',
                                                18 => 'tax_usdollar',
                                                19 => 'taxrate_id',
                                                20 => 'team_count',
                                                21 => 'team_count_link',
                                                22 => 'team_name',
                                                23 => 'taxable_subtotal',
                                                24 => 'total',
                                                25 => 'total_usdollar',
                                                26 => 'default_group',
                                                27 =>
                                                array(
                                                    'name' => 'product_bundle_items',
                                                    'fields' =>
                                                    array(
                                                        0 => 'name',
                                                        1 => 'quote_id',
                                                        2 => 'description',
                                                        3 => 'quantity',
                                                        4 => 'product_template_name',
                                                        5 => 'product_template_id',
                                                        6 => 'deal_calc',
                                                        7 => 'mft_part_num',
                                                        8 => 'discount_price',
                                                        9 => 'discount_amount',
                                                        10 => 'tax',
                                                        11 => 'tax_class',
                                                        12 => 'subtotal',
                                                        13 => 'position',
                                                        14 => 'currency_id',
                                                        15 => 'base_rate',
                                                        16 => 'discount_select',
                                                        17 => 'total_amount',
                                                        18 => 'unit_id',
                                                        19 => 'code',
                                                        20 => 'unit_name',
                                                        23 => 'discount_percent',
                                                        24 => 'discount_detail',
                                                        25 => 'product_discount',
                                                        26 => 'list_price',
                                                        27 => 'description_products',
                                                        28 => 'group_unit_id',
                                                    ),
                                                    'max_num' => -1,
                                                ),
                                            ),
                                            'max_num' => -1,
                                            'order_by' => 'position:asc',
                                        ),
                                        // 1 =>
                                        //     array(
                                        //         'name' => 'contact',
                                        //         'field' =>
                                        //             array(
                                        //                 0 => 'id',
                                        //                 1 => 'primary_address_street',
                                        //                 2 => 'primary_address_city',
                                        //                 3 => 'primary_address_state',
                                        //                 4 => 'primary_address_postalcode',
                                        //                 5 => 'primary_address_country',
                                        //             ),
                                        //     ),
                                        // 2 =>
                                        //     array(
                                        //         'name' => 'lead',
                                        //         'field' =>
                                        //             array(
                                        //                 0 => 'id',
                                        //                 1 => 'primary_address_street',
                                        //                 2 => 'primary_address_city',
                                        //                 3 => 'primary_address_state',
                                        //                 4 => 'primary_address_postalcode',
                                        //                 5 => 'primary_address_country',
                                        //             ),
                                        //     ),
                                    ),
                                ),
                                2 =>
                                array(
                                    'name' => 'favorite',
                                    'label' => 'LBL_FAVORITE',
                                    'type' => 'favorite',
                                    'dismiss_label' => true,
                                ),
                                3 =>
                                array(
                                    'name' => 'follow',
                                    'label' => 'LBL_FOLLOW',
                                    'type' => 'follow',
                                    'readonly' => true,
                                    'dismiss_label' => true,
                                ),
                                4 =>
                                array(
                                    'name' => 'status',
                                    'type' => 'event-status',
                                    'enum_width' => 'auto',
                                    'readonly' => true,
                                    'dropdown_width' => 'auto',
                                    'dropdown_class' => 'select2-menu-only',
                                    'container_class' => 'select2-menu-only',
                                ),
                                5 =>
                                array(
                                    'name' => 'quote_stage',
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
                            'columns' => 2,
                            'labelsOnTop' => true,
                            'placeholders' => true,
                            'newTab' => false,
                            'panelDefault' => 'expanded',
                            'fields' =>
                            array(
                                array(
                                    'name' => 'parent_name',
                                    'required' => true,
                                ),
                                // array(
                                //     'name' => 'quote_contact_name',
                                // ),
                                array(
                                    'name' => 'shipping_contact_name',
                                ),                                
                                array(
                                    'name' => 'opportunity_name',
                                    'related_fields' => array(
                                        'subtotal',
                                        'discount',
                                        'new_sub',
                                        'tax',
                                        'shipping',
                                    ),
                                ),
                                array(
                                    'name' => 'order_date',
                                    'required' => true,
                                    'default' => 'now',
                                    'span' => 6
                                ),
                                array(
                                    'name' => 'currency_id',
                                    'type' => 'currency-type-dropdown',
                                    'label' => 'LBL_CURRENCY',
                                    'related_fields' => array(
                                        'currency_id',
                                        'base_rate',
                                    ),
                                    'currency_field' => 'currency_id',
                                    'base_rate_field' => 'base_rate',
                                ),
                                array(
                                    'name' => 'billing_address',
                                    'type' => 'fieldset',
                                    'css_class' => 'address',
                                    'label' => 'LBL_BILLING_ADDRESS',
                                    'fields' =>
                                    array(
                                        0 =>
                                        array(
                                            'name' => 'billing_address_street',
                                            'css_class' => 'address_street',
                                            'placeholder' => 'LBL_BILLING_ADDRESS_STREET',
                                        ),
                                        1 =>
                                        array(
                                            'name' => 'billing_address_state',
                                            'css_class' => 'address_state',
                                            'placeholder' => 'LBL_BILLING_ADDRESS_STATE',
                                        ),
                                        2 =>
                                        array(
                                            'name' => 'billing_address_city',
                                            'css_class' => 'address_city',
                                            'placeholder' => 'LBL_BILLING_ADDRESS_CITY',
                                        ),
                                        3 =>
                                        array(
                                            'name' => 'billing_address_postalcode',
                                            'css_class' => 'address_zip',
                                            'placeholder' => 'LBL_BILLING_ADDRESS_POSTAL_CODE',
                                        ),
                                        4 =>
                                        array(
                                            'name' => 'billing_address_country',
                                            'css_class' => 'address_country',
                                            'placeholder' => 'LBL_BILLING_ADDRESS_COUNTRY',
                                        ),
                                    ),
                                ),
                                array(
                                    'name' => 'description',
                                    'span' => 6,
                                ),
                                array('name' => 'team_name', 'readonly' => false),
                                array('name' => 'assigned_user_name', 'readonly' => true),
                                array(
                                    'name' => 'date_entered_by',
                                    'readonly' => true,
                                    'type' => 'fieldset',
                                    'inline' => true,
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
                                    'type' => 'fieldset',
                                    'inline' => true,
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
                                array(
                                    'name' => 'non_db_field',
                                    'type' => 'fieldset',
                                    'css_class' => 'hidden',
                                    'css_style' => 'display:none',
                                    'fields' => array(
                                        array(
                                            'name' => 'total_balance_parent',
                                            'type' => 'currency',
                                            'css_class' => 'hidden',
                                            'dismiss_label' => true,
                                            'default' => false,
                                            'enabled' => true
                                        ),
                                        array(
                                            'name' => 'quote_discount_detail',
                                            'default' => false,
                                            'css_class' => 'hidden',
                                            'dismiss_label' => true,
                                            'enabled' => true
                                        ),
                                    )
                                )
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
