<?php
$viewdefs['DRI_SubWorkflows'] = 
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
                'label' => 'LBL_NAME',
                'related_fields' => 
                array (
                  0 => 'label',
                ),
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
                'name' => 'dri_workflow_name',
                'label' => 'LBL_DRI_WORKFLOW',
              ),
              1 => 
              array (
                'name' => 'dri_subworkflow_template_name',
                'label' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
              ),
              2 => 
              array (
                'name' => 'progress',
                'label' => 'LBL_PROGRESS',
                'type' => 'cj_progress_bar',
                'readonly' => true,
              ),
              3 => 
              array (
                'name' => 'momentum_ratio',
                'label' => 'LBL_MOMENTUM_RATIO',
                'type' => 'cj_momentum_bar',
                'readonly' => true,
              ),
              4 => 
              array (
                'name' => 'scoring',
                'inline' => true,
                'readonly' => true,
                'type' => 'fieldset',
                'label' => 'LBL_SCORING',
                'fields' => 
                array (
                  0 => 'score',
                  1 => 
                  array (
                    'type' => 'label',
                    'default_value' => ' / ',
                  ),
                  2 => 'points',
                ),
              ),
              5 => 
              array (
                'name' => 'momentum_scoring',
                'inline' => true,
                'readonly' => true,
                'type' => 'fieldset',
                'label' => 'LBL_MOMENTUM_SCORING',
                'fields' => 
                array (
                  0 => 'momentum_score',
                  1 => 
                  array (
                    'type' => 'label',
                    'default_value' => '/',
                  ),
                  2 => 'momentum_points',
                ),
              ),
              6 => 
              array (
                'name' => 'state',
                'label' => 'LBL_STATE',
              ),
              7 => 
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
              ),
              8 => 
              array (
                'name' => 'description',
                'comment' => 'Full text of the note',
                'label' => 'LBL_DESCRIPTION',
                'span' => 12,
              ),
              9 => 'date_started',
              10 => 'date_completed',
              11 => 'team_name',
              12 => 'assigned_user_name',
              13 => 
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
              ),
              14 => 
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
              ),
              15 => 
              array (
                'name' => 'tag',
                'span' => 12,
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
