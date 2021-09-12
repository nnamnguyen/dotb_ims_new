<?php
$module_name = 'C_SiteDeployment';
$viewdefs[$module_name] =
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
              'css_class' => 'btn customRecordViewButton',
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
              'customButton' => true,
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
                  'customButton' => true,
                  'acl_action' => 'edit',
                ),
                1 =>
                array(
                  'type' => 'rowaction',
                  'event' => 'button:audit_button:click',
                  'name' => 'audit_button',
                  'label' => 'LNK_VIEW_CHANGE_LOG',
                  'acl_action' => 'view',
                ),
                2 =>
                array(
                  'type' => 'divider',
                ),
                3 =>
                array(
                  'type' => 'rowaction',
                  'event' => 'button:update_code_server:click',
                  'name' => 'update_code_server_button',
                  'label' => 'LBL_UPDATE_CODE_SERVER',
                  'acl_action' => 'create',
                ),
                4 =>
                array(
                  'type' => 'rowaction',
                  'event' => 'button:recheckapplicense:click',
                  'name' => 'recheckapplicenser_button',
                  'label' => 'LBL_RECHECK_APP_LICENSE',
                  'acl_action' => 'create',
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
              'label' => 'LBL_RECORD_HEADER',
              'header' => true,
              'fields' =>
              array(
                0 =>
                array(
                  'name' => 'picture',
                  'type' => 'avatar',
                  'width' => 42,
                  'height' => 42,
                  'dismiss_label' => true,
                  'readonly' => true,
                ),
                1 =>
                array(
                  'name' => 'name',
                  'label' => 'LBL_DOMAIN',
                ),
                2 =>
                array(
                  'name' => 'favorite',
                  'label' => 'LBL_FAVORITE',
                  'type' => 'favorite',
                  'readonly' => true,
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
              ),
            ),
            1 =>
            array(
              'name' => 'panel_body',
              'label' => 'LBL_RECORD_BODY',
              'columns' => 2,
              'labelsOnTop' => true,
              'placeholders' => true,
              'newTab' => true,
              'panelDefault' => 'expanded',
              'fields' =>
              array(
                // 'parent_name',
                'sitedeployment_account_name',
                'sitedeployment_contact_name',
                // 'contacts_c_sitedeployment_name',
                array(
                  'name' => 'git_url',
                ),
                array(
                  'name' => 'quotes_c_sitedeployment_1_name',
                ),
                array(
                  "name" => 'stage',
                ),
                array(
                  'name' => 'status',
                  'label' => 'LBL_STATUS',
                ),
                array(
                  'name' => 'user_admin',
                  'label' => 'LBL_USER_ADMIN',
                ),
                'db_name',
                array(
                  'name' => 'pass_admin',
                  'label' => 'LBL_PASS_ADMIN',
                ),
                'db_pass',
                'date_start_crm',
                'date_expired_crm',
                array(
                  'name' => 'description',
                ),
                'assigned_user_name',

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
              ),
            ),
            2 =>
            array(
              'newTab' => true,
              'panelDefault' => 'expanded',
              'name' => 'LBL_RECORDVIEW_PANEL1',
              'label' => 'LBL_SITEDEPLOYMENT_LICENSE',
              'columns' => 2,
              'labelsOnTop' => 1,
              'placeholders' => 1,
              'fields' =>
              array(
                // 0 => 'lic_key_crm',
                array(
                  'name' => 'lic_users_crm',
                  'label' => 'LBL_LIC_USERS_CRM',
                  'required' => true
                  
                ),
                array(),
                'lic_teams',
                array(
                  'name' => 'lic_storages',
                  'label' => 'LBL_LIC_STORAGES',
                  'required' => true
                ),
                array(
                  'name' => 'date_start_crm',
                  'label' => 'LBL_DATE_START',
                  'required' => true
                ),
                array(
                  'name' => 'date_expired_crm',
                  'required' => true
                ),
                // 10 => 'lic_key_mobile',
                'lic_users_mobile',
                array(),
                'date_start_mobile',
                'date_expired_mobile',
              ),
            ),
            3 =>
            array(
              'newTab' => true,
              'panelDefault' => 'expanded',
              'name' => 'LBL_DOCKER_INFO',
              'label' => 'LBL_DOCKER_INFO',
              'columns' => 2,
              'labelsOnTop' => 1,
              'placeholders' => 1,
              'fields' =>
              array(
                // 0 =>
                // array(
                //   'name' => 'lic_type',
                //   'label' => 'LBL_LIC_TYPE',
                //   'required' => true
                // ),
              ),
            ),
          ),
          'templateMeta' =>
          array(
            'useTabs' => true,
          ),
        ),
      ),
    ),
  );
