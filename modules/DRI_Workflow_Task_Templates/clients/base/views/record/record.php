<?php
$viewdefs['DRI_Workflow_Task_Templates'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'record' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_HEADER',
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
                'link' => false,
              ),
              2 => 
              array (
                'name' => 'favorite',
                'label' => 'LBL_FAVORITE',
                'type' => 'favorite',
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
            ),
          ),
          1 => 
          array (
            'name' => 'panel_body',
            'label' => 'LBL_PANEL_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'newTab' => false,
            'panelDefault' => 'expanded',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'activity_type',
                'label' => 'LBL_ACTIVITY_TYPE',
              ),
              1 => 
              array (
                'name' => 'type',
                'label' => 'LBL_TYPE',
              ),
              2 => 
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
              ),
              3 => 'points',
              4 => 
              array (
                'name' => 'blocked_by',
                'label' => 'LBL_BLOCKED_BY',
                'type' => 'blocked_by',
                'related_fields' => 
                array (
                  0 => 'dri_workflow_template_id',
                ),
                'span' => 6,
              ),
              5 => 
              array (
                'name' => 'dri_workflow_template_name',
                'readonly' => true,
                'label' => 'LBL_DRI_WORKFLOW_TEMPLATE',
                'span' => 6,
              ),
              6 => 
              array (
                'name' => 'priority',
                'label' => 'LBL_PRIORITY',
              ),
              7 => 
              array (
                'name' => 'url',
                'label' => 'LBL_URL',
              ),
              8 => 
              array (
                'name' => 'direction',
              ),
              9 => 
              array (
                'name' => 'send_invites',
                'label' => 'LBL_SEND_INVITES',
                'span' => 6,
              ),
              10 => 
              array (
                'name' => 'time_of_day',
                'type' => 'cj_time',
              ),
              11 => 
              array (
              ),
              12 => 
              array (
                'name' => 'assignee_rule',
                'label' => 'LBL_ASSIGNEE_RULE',
              ),
              13 => 
              array (
                'name' => 'target_assignee',
              ),
              14 => 
              array (
                'name' => 'target_assignee_team_name',
              ),
              15 => 'target_assignee_user_name',
            ),
          ),
          2 => 
          array (
            'newTab' => false,
            'panelDefault' => 'expanded',
            'name' => 'LBL_RECORDVIEW_PANEL2',
            'label' => 'LBL_RECORDVIEW_PANEL2',
            'columns' => 2,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'task_due_date_type',
                'label' => 'LBL_TASK_DUE_DATE_TYPE',
              ),
              1 => 
              array (
                'name' => 'task_due_days',
                'label' => 'LBL_TASK_DUE_DAYS',
              ),
              2 => 'due_date_module',
              3 => 
              array (
                'name' => 'due_date_field',
                'type' => 'due_date_field',
              ),
            ),
          ),
          3 => 
          array (
            'newTab' => false,
            'panelDefault' => 'expanded',
            'name' => 'LBL_RECORDVIEW_PANEL3',
            'label' => 'LBL_RECORDVIEW_PANEL3',
            'columns' => 2,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'momentum_start_type',
                'label' => 'LBL_MOMENTUM_START_TYPE',
              ),
              1 => 
              array (
                'name' => 'momentum_points',
                'label' => 'LBL_MOMENTUM_POINTS',
              ),
              2 => 
              array (
                'name' => 'momentum_due_days',
                'label' => 'LBL_MOMENTUM_DUE_DAYS',
              ),
              3 => 
              array (
                'name' => 'momentum_due_hours',
                'label' => 'LBL_MOMENTUM_DUE_HOURS',
              ),
              4 => 
              array (
                'name' => 'momentum_start_module',
                'label' => 'LBL_MOMENTUM_START_MODULE',
              ),
              5 => 
              array (
                'name' => 'momentum_start_field',
                'type' => 'momentum_start_field',
                'label' => 'LBL_MOMENTUM_START_FIELD',
              ),
            ),
          ),
          4 => 
          array (
            'newTab' => false,
            'panelDefault' => 'expanded',
            'name' => 'LBL_RECORDVIEW_PANEL1',
            'label' => 'LBL_RECORDVIEW_PANEL1',
            'columns' => 2,
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'description',
                'comment' => 'Full text of the note',
                'label' => 'LBL_DESCRIPTION',
                'span' => 12,
              ),
              1 => 
              array (
                'name' => 'tag',
                'span' => 6,
              ),
              2 => 
              array (
                'name' => 'team_name',
                'span' => 6,
              ),
              3 => 
              array (
                'name' => 'date_entered_by',
                'readonly' => true,
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
                'span' => 6,
              ),
              4 => 
              array (
                'name' => 'date_modified_by',
                'readonly' => true,
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
                'span' => 6,
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
