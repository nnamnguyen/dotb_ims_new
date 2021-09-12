<?php
$viewdefs['Leads'] = 
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
            'css_class' => 'btn customRecordViewButton',
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
            'customButton' => true,
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
                'customButton' => true,
                'acl_action' => 'edit',
              ),
              1 => 
              array (
                'type' => 'convertbutton',
                'name' => 'lead_convert_button',
                'label' => 'LBL_CONVERT_BUTTON_LABEL',
                'acl_action' => 'edit',
              ),
              2 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:duplicate_button:click',
                'name' => 'duplicate_button',
                'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                'acl_module' => 'Leads',
                'acl_action' => 'create',
              ),
              3 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:audit_button:click',
                'name' => 'audit_button',
                'label' => 'LNK_VIEW_CHANGE_LOG',
                'acl_action' => 'view',
              ),
              4 => 
              array (
                'type' => 'divider',
              ),
              5 => 
              array (
                'type' => 'rowaction',
                'event' => 'button:delete_button:click',
                'name' => 'delete_button',
                'label' => 'LBL_DELETE_BUTTON_LABEL',
                'acl_action' => 'delete',
              ),
              6 => 
              array (
                'name' => 'send_survey',
                'type' => 'rowaction',
                'label' => 'Send Survey',
                'acl_action' => 'send_survey',
                'event' => 'button:send_survey:click',
              ),
              7 => 
              array (
                'name' => 'send_poll',
                'type' => 'rowaction',
                'label' => 'Send Poll',
                'acl_action' => 'send_poll',
                'event' => 'button:send_poll:click',
              ),
              8 => 
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
                'type' => 'fullname',
                'label' => 'LBL_NAME',
                'dismiss_label' => true,
                'fields' => 
                array (
                  0 => 
                  array (
                    'name' => 'salutation',
                    'type' => 'enum',
                    'enum_width' => 'auto',
                    'searchBarThreshold' => 7,
                  ),
                  1 => 'first_name',
                  2 => 'last_name',
                ),
              ),
              2 => 
              array (
                'type' => 'favorite',
              ),
              3 => 
              array (
                'name' => 'status',
                'type' => 'event-status',
                'enum_width' => 'auto',
                'dropdown_width' => 'auto',
                'dropdown_class' => 'select2-menu-only',
                'container_class' => 'select2-menu-only',
              ),
              4 => 
              array (
                'type' => 'follow',
                'readonly' => true,
              ),
              5 => 
              array (
                'name' => 'converted',
                'type' => 'badge',
                'dismiss_label' => true,
                'readonly' => true,
                'related_fields' => 
                array (
                  0 => 'account_id',
                  1 => 'account_name',
                  2 => 'contact_id',
                  3 => 'contact_name',
                  4 => 'opportunity_id',
                  5 => 'opportunity_name',
                  6 => 'converted_opp_name',
                ),
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'labels' => true,
            'labelsOnTop' => true,
            'placeholders' => true,
            // 'newTab' => true,
            'panelDefault' => 'expanded',
            'fields' => 
            array (
              array (
                'name' => 'job_title',
                'label' => 'LBL_JOB_TITLE',
              ),
              array (
                'name' => 'birthdate',
              ),
              array (
                'name' => 'email',
              ),
              array (
                'name' => 'phone_mobile',
              ),
            ),
          ),
          2 => 
          array (
            'name' => 'panel_hidden',
            'label' => 'LBL_RECORD_SHOWMORE',
            'hide' => true,
            'columns' => 2,
            'labels' => true,
            'labelsOnTop' => true,
            'placeholders' => true,
            // 'newTab' => true,
            'panelDefault' => 'expanded',
            'fields' => 
            array (
              0 => 'account_name',
              1 => 
              array (
                'name' => 'international_name',
                'label' => 'LBL_INTERNATIONAL_NAME',
              ),
              2 => 
              array (
                'name' => 'institution_type',
                'label' => 'LBL_INSTITUTION_TYPE',
              ),
              3 => 
              array (
                'name' => 'employees',
                'label' => 'LBL_EMPLOYEES',
              ),
              4 => 'website',
              5 => 'phone_work',  
              6  => 
              array (
                'name' => 'size_of_company',
                'label' => 'LBL_SIZE_OF_COMPANY',
              ),
              7  => 
              array (),            
              8 => 
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
              9 => 
              array (
                'name' => 'description',
              ),
            ),
          ),
          3 => 
          array (
            // 'newTab' => true,
            'panelDefault' => 'expanded',
            'name' => 'LBL_RECORDVIEW_PANEL1',
            'label' => 'LBL_OTHER_INFO',
            'columns' => 2,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 'lead_source',
              1 => 'lead_source_description',
              2 => 
              array (
                'name' => 'channel',
                'label' => 'LBL_CHANNEL',
              ),
              3 => 'campaign_name',
              4 => 'facebook',
              5 => 'reference',
              6 => 'utm_source',
              7 => 'utm_medium',
              8 => 'utm_content',
              9 => 'utm_campaign',
              10 => 'reference_product',
              11 => 'tag',
              12 => 'team_name',
              13 => 'assigned_user_name',
              14 => 'date_entered',
              15 => 'date_modified',
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
