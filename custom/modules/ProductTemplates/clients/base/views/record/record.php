<?php
$viewdefs['ProductTemplates'] =
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
              'css_class' => 'btn',
              'showOn' => 'edit',
              'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
              'icon' => 'fa-times',
              'customButton' => true,
              'dismiss_label' => true,
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
              'css_class' => 'btn btn-primary',
              'showOn' => 'edit',
              'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
              'icon' => 'fa-save',
              'customButton' => true,
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
                  'label' => 'LBL_EDIT_BUTTON_LABEL',
                  'tooltip' => 'LBL_EDIT_BUTTON_LABEL',
                  'icon' => 'fa-pencil',
                  'customButton' => true,
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
                  'type' => 'pdfaction',
                  'name' => 'download-pdf',
                  'label' => 'LBL_PDF_VIEW',
                  'action' => 'download',
                  'acl_action' => 'view',
                ),
                3 =>
                array(
                  'type' => 'pdfaction',
                  'name' => 'email-pdf',
                  'label' => 'LBL_PDF_EMAIL',
                  'action' => 'email',
                  'acl_action' => 'view',
                ),
                4 =>
                array(
                  'type' => 'divider',
                ),
                5 =>
                array(
                  'type' => 'rowaction',
                  'event' => 'button:find_duplicates_button:click',
                  'name' => 'find_duplicates_button',
                  'label' => 'LBL_DUP_MERGE',
                  'acl_action' => 'edit',
                ),
                6 =>
                array(
                  'type' => 'rowaction',
                  'event' => 'button:duplicate_button:click',
                  'name' => 'duplicate_button',
                  'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                  'acl_module' => 'ProductTemplates',
                  'acl_action' => 'create',
                ),
                7 =>
                array(
                  'type' => 'divider',
                ),
                8 =>
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
                ),
                2 => array(
                  'name' => 'is_allocation',
                )
              ),
            ),
            1 =>
            array(
              'name' => 'panel_body',
              'label' => 'LBL_RECORD_BODY',
              'columns' => 2,
              'labels' => true,
              'labelsOnTop' => true,
              'placeholders' => true,
              'newTab' => false,
              'panelDefault' => 'expanded',
              'fields' =>
              array(
                0 =>
                array(
                  'name' => 'code',
                  'comment' => 'code of the product',
                  'studio' => 'visible',
                  'label' => 'LBL_CODE',
                ),
                'category_name',
                array(
                  'name' => 'status2',
                  'label' => 'LBL_STATUS_2',
                ),
                'type_name',
                'discount_price',
                'list_price',
                array(
                  'name' => 'group_unit_name',
                  'studio' => 'visible',
                  'label' => 'LBL_GROUP_UNIT_NAME',
                ),
                'number_of_user',
                // array(
                //   'name' => 'unit_name',
                //   'required' => 'true',
                // ),
                'date_available',
                array(),
                array(
                  'name' => 'description',
                  'span' => 6,
                ),
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
              )
            ),
            2 => array(
              'name' => 'panel_supplier_panel',
              'label' => 'LBL_SUPPLIER_PANEL',
              'columns' => 2,
              'labels' => true,
              'labelsOnTop' => true,
              'placeholders' => true,
              'newTab' => false,
              'panelDefault' => 'expanded',
              'fields' =>
              array(
                'support_name',
                'support_contact',
                'support_term',
                'support_description'
              )
            )
          ),
          'templateMeta' =>
          array(
            'useTabs' => false,
          ),
        ),
      ),
    ),
  );
