<?php
$module_name = 'J_PaymentDetail';
$viewdefs[$module_name] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'record' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'type' => 'button',
            'name' => 'cancel_button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn',
            'showOn' => 'edit',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'icon' => 'fa-times',
            'customButton' => true,
            'dismiss_label' => true,
            'events' => 
            array (
              'click' => 'button:cancel_button:click',
            ),
          ),
          1 => 
          array (
            'type' => 'rowaction',
            'event' => 'button:save_button:click',
            'name' => 'save_button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'css_class' => 'btn btn-primary',
            'showOn' => 'edit',
            'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
            'icon' => 'fa-save',
            'customButton' => true,
            'acl_action' => 'edit',
          ),
          2 => 
          array (
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'primary' => true,
            'showOn' => 'view',
            'buttons' => 
            array (
              0 =>
              array (
                  'type' => 'rowaction',
                  'name' => 'void',
                  'label' => 'LBL_VOID',
                  'acl_action' => 'view',
                  'event' => 'list:voidInvoice:fire',
              ),
              1 => 
              array (
                'type' => 'shareaction',
                'name' => 'share',
                'label' => 'LBL_RECORD_SHARE_BUTTON',
                'acl_action' => 'view',
              ),
//              2 =>
//              array (
//                'type' => 'pdfaction',
//                'name' => 'download-pdf',
//                'label' => 'LBL_PDF_VIEW',
//                'action' => 'download',
//                'acl_action' => 'view',
//              ),
//              3 =>
//              array (
//                'type' => 'pdfaction',
//                'name' => 'email-pdf',
//                'label' => 'LBL_PDF_EMAIL',
//                'action' => 'email',
//                'acl_action' => 'view',
//              ),
//              4 =>
//              array (
//                'type' => 'divider',
//              ),
              5 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:find_duplicates_button:click',
                'name' => 'find_duplicates_button',
                'label' => 'LBL_DUP_MERGE',
                'acl_action' => 'edit',
              ),
              6 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:duplicate_button:click',
                'name' => 'duplicate_button',
                'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                'acl_module' => 'J_PaymentDetail',
                'acl_action' => 'create',
              ),
              7 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:audit_button:click',
                'name' => 'audit_button',
                'label' => 'LNK_VIEW_CHANGE_LOG',
                'acl_action' => 'view',
              ),
              8 => 
              array (
                'type' => 'divider',
              ),
              9 =>
              array (
                'type' => 'rowaction',
                'event' => 'button:delete_button:click',
                'name' => 'delete_button',
                'label' => 'LBL_DELETE_BUTTON_LABEL',
                'acl_action' => 'delete',
              ),
            ),
          ),
          3 => 
          array (
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
          ),
        ),
        'panels' => 
        array (
          0 => 
          array (
            'name' => 'panel_header',
            'label' => 'LBL_RECORD_HEADER',
            'header' => true,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'picture',
                'type' => 'avatar',
                'width' => 42,
                'height' => 42,
                'dismiss_label' => true,
                'readonly' => true,
              ),
            1 =>
                array (
                    'name' => 'name',
                    'required' => false,
                    'placeholder' => '--auto-generate--',
                    'events' =>
                        array (
                            'keyup' => 'update:quote',
                        ),
                    'related_fields' =>
                        array (
                            0 =>
                                array (
                                    'name' => 'quote',
                                    'field' =>
                                        array (
                                            0 => 'unpaid_amount',
                                            1 => 'parent_type',
                                            2 => 'parent_id',
                                            3 => 'parent_name'
                                        ),
                                ),
                        ),
                ),
              2 =>
              array (
                'name' => 'favorite',
                'label' => 'LBL_FAVORITE',
                'type' => 'favorite',
                'readonly' => true,
                'dismiss_label' => true,
              ),
              3 =>
              array (
                'name' => 'follow',
                'label' => 'LBL_FOLLOW',
                'type' => 'follow',
                'readonly' => true,
                'dismiss_label' => true,
              ),
                4 =>
                    array (
                        'name' => 'payment_type',
                        'label' => 'LBL_PAYMENT_TYPE',
                        'type' => 'event-status',
                        'enum_width' => 'auto',
                        'dropdown_width' => 'auto',
                        'dropdown_class' => 'select2-menu-only',
                        'container_class' => 'select2-menu-only',
                    ),
                5 =>
                    array (
                        'name' => 'status',
                        'type' => 'event-status',
                        'default' => 'Paid',
                        'enum_width' => 'auto',
                        'dropdown_width' => 'auto',
                        'dropdown_class' => 'select2-menu-only',
                        'container_class' => 'select2-menu-only',
                    ),
            ),
          ),
          1 => 
          array (
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'newTab' => false,
            'panelDefault' => 'expanded',
            'fields' => 
            array (
                0=>array(
                    'name'=>'quote_name',
                    'required'=>true,
                ),
                1=> 'payment_amount',
                2=>'parent_name',
                3=> array(
                    'name' => 'payment_date',
                    'type' =>'jdate',
                    'default' => 'now',
                    'required' => true
                ),
                4 => array(
                    'name'=>'assigned_user_name',
                    'readonly' => true,
                ),
                5=> array('name'=>'payment_method','required' =>true),
                6 => array(
                    'name'=>'team_name',
                    'readonly'=>true),
                7=> 'card_type',
                8 => array (
                    'name' => 'date_modified_by',
                    'readonly' => true,
                    'inline' => true,
                    'type' => 'fieldset',
                    'label' => 'LBL_DATE_MODIFIED',
                    'fields' =>
                        array (
                            0 =>
                                array (
                                    'name' => 'date_modified',
                                ),
                            1 =>
                                array (
                                    'type' => 'label',
                                    'default_value' => 'LBL_BY',
                                ),
                            2 =>
                                array (
                                    'name' => 'modified_by_name',
                                ),
                        ),
                ),
                9=> 'pos_code',
                10 => array (
                    'name' => 'date_entered_by',
                    'readonly' => true,
                    'inline' => true,
                    'type' => 'fieldset',
                    'label' => 'LBL_DATE_ENTERED',
                    'fields' =>
                        array (
                            0 =>
                                array (
                                    'name' => 'date_entered',
                                ),
                            1 =>
                                array (
                                    'type' => 'label',
                                    'default_value' => 'LBL_BY',
                                ),
                            2 =>
                                array (
                                    'name' => 'created_by_name',
                                ),
                        ),
                ),
                11=> 'bank_account',
                14 => array (
                    'name' => 'description',
                    'span' => 12,
                    'placeholder' => '--auto generate if empty--'
                ),
            ),
          ),
        ),
        'templateMeta' => 
        array (
          'useTabs' => false,
        ),
      ),
    ),
  ),
);
