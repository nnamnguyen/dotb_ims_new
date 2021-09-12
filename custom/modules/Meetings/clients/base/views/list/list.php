<?php
$viewdefs['Meetings'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'list' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'label' => 'LBL_PANEL_1',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'name',
                'label' => 'LBL_LIST_SUBJECT',
                'link' => true,
                'default' => true,
                'enabled' => true,
                'related_fields' => 
                array (
                  0 => 'repeat_type',
                ),
                'width' => 'small',
              ),
              1 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
                'width' => 'large',
              ),
              2 => 
              array (
                'name' => 'parent_name',
                'label' => 'LBL_LIST_RELATED_TO',
                'id' => 'PARENT_ID',
                'link' => true,
                'default' => true,
                'enabled' => true,
                'sortable' => false,
              ),
              3 => 
              array (
                'name' => 'date_start',
                'label' => 'LBL_LIST_DATE',
                'type' => 'datetimecombo-colorcoded',
                'css_class' => 'overflow-visible',
                'completed_status_value' => 'Held',
                'link' => false,
                'default' => true,
                'enabled' => true,
                'readonly' => true,
                'related_fields' => 
                array (
                  0 => 'status',
                ),
              ),
              4 => 
              array (
                'name' => 'date_end',
                'link' => false,
                'default' => true,
                'enabled' => true,
              ),
              5 => 
              array (
                'name' => 'status',
                'type' => 'event-status',
                'label' => 'LBL_LIST_STATUS',
                'link' => false,
                'default' => true,
                'enabled' => true,
                'css_class' => 'full-width',
              ),
              6 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_LIST_ASSIGNED_USER',
                'id' => 'ASSIGNED_USER_ID',
                'default' => true,
                'enabled' => true,
              ),
              7 => 
              array (
                'name' => 'location',
                'label' => 'LBL_LOCATION',
                'enabled' => true,
                'default' => false,
              ),
              8 => 
              array (
                'name' => 'created_by_name',
                'label' => 'LBL_CREATED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'CREATED_BY',
                'link' => true,
                'default' => false,
              ),
              9 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_LIST_TEAM',
                'default' => false,
                'enabled' => true,
              ),
              10 => 
              array (
                'name' => 'reminder_time',
                'label' => 'LBL_POPUP_REMINDER_TIME',
                'enabled' => true,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'send_invites',
                'label' => 'LBL_SEND_INVITES',
                'enabled' => true,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'email_reminder_time',
                'label' => 'LBL_EMAIL_REMINDER_TIME',
                'enabled' => true,
                'default' => false,
              ),
              13 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'default' => false,
                'enabled' => true,
                'readonly' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
