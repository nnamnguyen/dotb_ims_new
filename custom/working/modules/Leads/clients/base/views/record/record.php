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
            'newTab' => false,
            'panelDefault' => 'collapsed',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'phone_mobile',
              ),
              1 => 
              array (
                'name' => 'email',
              ),
              2 => 
              array (
                'name' => 'job_title',
                'label' => 'LBL_JOB_TITLE',
              ),
              3 => 
              array (
                'name' => 'question_comment',
                'comment' => 'Question/comment of lead contact',
                'label' => 'LBL_QUESTION_COMMENT',
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
            'newTab' => false,
            'panelDefault' => 'collapsed',
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
              6 => 
              array (
                'name' => 'address_city_2',
                'label' => 'LBL_ADDRESS_CITY_2',
              ),
              7 => 
              array (
                'name' => 'address_state_2',
                'label' => 'LBL_ADDRESS_STATE_2',
              ),
              8 => 
              array (
                'name' => 'description',
                'span' => 12,
              ),
            ),
          ),
          3 => 
          array (
            'newTab' => false,
            'panelDefault' => 'collapsed',
            'name' => 'LBL_RECORDVIEW_PANEL1',
            'label' => 'LBL_RECORDVIEW_PANEL1',
            'columns' => 2,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 'lead_source',
              1 => 'lead_source_description',
              2 => 
              array (
                'name' => 'tag',
                'span' => 6,
              ),
              3 => 
              array (
                'name' => 'team_name',
                'span' => 6,
              ),
              4 => 
              array (
                'name' => 'channel',
                'label' => 'LBL_CHANNEL',
              ),
              5 => 'campaign_name',
              6 => 
              array (
                'name' => 'size_of_company',
                'label' => 'LBL_SIZE_OF_COMPANY',
              ),
              7 => 
              array (
                'name' => 'assigned_user_name',
              ),
            ),
          ),
          4 => 
          array (
            'newTab' => false,
            'panelDefault' => 'collapsed',
            'name' => 'LBL_RECORDVIEW_PANEL2',
            'label' => 'LBL_RECORDVIEW_PANEL2',
            'columns' => 2,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'prefer_product',
                'label' => 'LBL_PREFER_PRODUCT',
              ),
              1 => 
              array (
                'name' => 'trail_domain',
                'label' => 'LBL_TRAIL_DOMAIN',
              ),
              2 => 
              array (
                'name' => 'username_demo',
                'label' => 'LBL_USERNAME',
              ),
              3 => 
              array (
                'name' => 'password_demo',
                'label' => 'LBL_PASSWORD',
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
