<?php
$viewdefs['Contacts'] = 
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
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn ',
            'icon' => 'fa-window-close',
            'showOn' => 'edit',
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
            'tooltip' => 'LBL_SAVE_BUTTON_LABEL',
            'icon' => 'fa-save',
            'css_class' => 'btn btn-primary',
            'showOn' => 'edit',
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
                'event' => 'button:edit_button:click',
                'name' => 'edit_button',
                'tooltip' => 'LBL_EDIT_BUTTON_LABEL',
                'label' => 'LBL_EDIT_BUTTON_LABEL',
                'icon' => 'fa-pencil',
                'acl_action' => 'edit',
              ),
              1 => 
              array (
                'type' => 'shareaction',
                'name' => 'share',
                'label' => 'LBL_RECORD_SHARE_BUTTON',
                'acl_action' => 'view',
              ),
              2 => 
              array (
                'type' => 'pdfaction',
                'name' => 'download-pdf',
                'label' => 'LBL_PDF_VIEW',
                'action' => 'download',
                'acl_action' => 'view',
              ),
              3 => 
              array (
                'type' => 'pdfaction',
                'name' => 'email-pdf',
                'label' => 'LBL_PDF_EMAIL',
                'action' => 'email',
                'acl_action' => 'view',
              ),
              4 => 
              array (
                'type' => 'divider',
              ),
              5 => 
              array (
                'type' => 'manage-subscription',
                'name' => 'manage_subscription_button',
                'label' => 'LBL_MANAGE_SUBSCRIPTIONS',
                'showOn' => 'view',
                'value' => 'edit',
              ),
              6 => 
              array (
                'type' => 'vcard',
                'name' => 'vcard_button',
                'label' => 'LBL_VCARD_DOWNLOAD',
                'acl_action' => 'edit',
              ),
              7 => 
              array (
                'type' => 'divider',
              ),
              8 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:find_duplicates_button:click',
                'name' => 'find_duplicates',
                'label' => 'LBL_DUP_MERGE',
                'acl_action' => 'edit',
              ),
              9 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:duplicate_button:click',
                'name' => 'duplicate_button',
                'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                'acl_module' => 'Contacts',
                'acl_action' => 'create',
              ),
              10 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:historical_summary_button:click',
                'name' => 'historical_summary_button',
                'label' => 'LBL_HISTORICAL_SUMMARY',
                'acl_action' => 'view',
              ),
              11 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:audit_button:click',
                'name' => 'audit_button',
                'label' => 'LNK_VIEW_CHANGE_LOG',
                'acl_action' => 'view',
              ),
              12 => 
              array (
                'type' => 'divider',
              ),
              13 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:delete_button:click',
                'name' => 'delete_button',
                'label' => 'LBL_DELETE_BUTTON_LABEL',
                'acl_action' => 'delete',
              ),
              14 => 
              array (
                'name' => 'send_survey',
                'type' => 'rowaction',
                'label' => 'Send Survey',
                'acl_action' => 'send_survey',
                'event' => 'button:send_survey:click',
              ),
              15 => 
              array (
                'name' => 'send_poll',
                'type' => 'rowaction',
                'label' => 'Send Poll',
                'acl_action' => 'send_poll',
                'event' => 'button:send_poll:click',
              ),
              16 => 
              array (
                'name' => 'take_survey',
                'type' => 'rowaction',
                'label' => 'Take Survey',
                'acl_action' => 'take_survey',
                'event' => 'button:take_survey:click',
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
            'header' => true,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'picture',
                'type' => 'avatar',
                'size' => 'large',
                'dismiss_label' => true,
              ),
              1 => 
              array (
                'name' => 'name',
                'label' => 'LBL_NAME',
                'dismiss_label' => true,
                'type' => 'fullname',
                'fields' => 
                array (
                  0 => 'salutation',
                  1 => 'first_name',
                  2 => 'last_name',
                ),
              ),
              2 => 
              array (
                'name' => 'favorite',
                'label' => 'LBL_FAVORITE',
                'type' => 'favorite',
                'dismiss_label' => true,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'panel_body',
            'label' => 'LBL_CONTACT_INFO',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            // 'newTab' => true,
            'panelDefault' => 'expanded',
            'fields' => 
            array (
              'account_name',
              'report_to_name',
              'job_title',
              array (
                'name' => 'birthdate',
                'comment' => 'The birthdate of the contact',
                'label' => 'LBL_BIRTHDATE',
              ),
              'email',
              array (
                'name' => 'phone_mobile',
                'type' => 'phone',
                'label' => 'LBL_PHONE_MOBILE',
                'enableSMS' => true,
              ), 
              'department',
              'office_phone',
              array (
                'name' => 'primary_address',
                'type' => 'fieldset',
                'css_class' => 'address',
                'label' => 'LBL_PRIMARY_ADDRESS',
                'fields' => 
                array (
                  0 => 
                  array (
                    'name' => 'primary_address_street',
                    'css_class' => 'address_street',
                    'placeholder' => 'LBL_PRIMARY_ADDRESS_STREET',
                  ),
                  1 => 
                  array (
                    'name' => 'primary_address_postalcode',
                    'css_class' => 'address_zip',
                    'placeholder' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
                  ),
                  2 => 
                  array (
                    'name' => 'primary_address_state',
                    'css_class' => 'address_state',
                    'placeholder' => 'LBL_PRIMARY_ADDRESS_STATE',
                  ),
                  3 => 
                  array (
                    'name' => 'primary_address_city',
                    'css_class' => 'address_city',
                    'placeholder' => 'LBL_PRIMARY_ADDRESS_CITY',
                  ),
                  4 => 
                  array (
                    'name' => 'primary_address_country',
                    'css_class' => 'address_country',
                    'placeholder' => 'LBL_PRIMARY_ADDRESS_COUNTRY',
                  ),
                  5 => 
                  array (
                    'name' => 'pri_latitude',
                    'css_class' => 'hidden',
                  ),
                  6 => 
                  array (
                    'name' => 'pri_longitude',
                    'css_class' => 'hidden',
                  ),
                ),
              ),
              'description',
            ),
          ),
          2 => 
          array (
            'columns' => 2,
            'name' => 'panel_activity_info',
            'label' => 'LBL_ACTIVITY_INFO',
            'hide' => true,
            'labelsOnTop' => true,
            'placeholders' => true,
            // 'newTab' => true,
            'panelDefault' => 'collapsed',
            'fields' => 
            array (
              0 => 'lead_source',
              // 1 => 'lead_source_description',//xoa field này
              1 => 'campaign_name',
              2 => 'utm_source',
              3 => 
              array (
                'name' => 'assistant',
                'comment' => 'Name of the assistant of the contact',
                'label' => 'LBL_ASSISTANT',
              ),
              4 => 'sync_contact',
              5 => 
              array (
                'name' => 'assistant_phone',
                'comment' => 'Phone number of the assistant of the contact',
                'label' => 'LBL_ASSISTANT_PHONE',
              ),  
              6 => 'team_name',      
              7 => 'assigned_user_name',
              8 => 
              array (
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
              9 => 
              array (
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
            ),
          ),
        ),
        'templateMeta' => 
        array (
          'useTabs' => true,
        ),
      ),
    ),
  ),
);
