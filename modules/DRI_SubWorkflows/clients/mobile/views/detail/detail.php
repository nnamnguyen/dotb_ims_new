<?php
$module_name = 'DRI_SubWorkflows';
$viewdefs[$module_name] = 
array (
  'mobile' => 
  array (
    'view' => 
    array (
      'detail' => 
      array (
        'templateMeta' => 
        array (
          'form' => 
          array (
            'buttons' => 
            array (
              0 => 'EDIT',
              1 => 'DUPLICATE',
              2 => 'DELETE',
            ),
          ),
          'maxColumns' => '1',
          'widths' => 
          array (
            0 => 
            array (
              'label' => '10',
              'field' => '30',
            ),
            1 => 
            array (
              'label' => '10',
              'field' => '30',
            ),
          ),
          'useTabs' => false,
        ),
        'panels' => 
        array (
          0 => 
          array (
            'label' => 'LBL_PANEL_DEFAULT',
            'newTab' => false,
            'panelDefault' => 'expanded',
            'name' => 'LBL_PANEL_DEFAULT',
            'columns' => '1',
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 'name',
              1 => 
              array (
                'name' => 'dri_workflow_name',
                'label' => 'LBL_DRI_WORKFLOW',
              ),
              2 => 
              array (
                'name' => 'dri_subworkflow_template_name',
                'label' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
              ),
              3 => 
              array (
                'name' => 'progress',
                'readonly' => true,
                'label' => 'LBL_PROGRESS',
              ),
              4 => 
              array (
                'name' => 'momentum_ratio',
                'readonly' => true,
                'label' => 'LBL_MOMENTUM_RATIO',
              ),
              5 => 
              array (
                'name' => 'score',
                'readonly' => true,
                'label' => 'LBL_SCORE',
              ),
              6 => 
              array (
                'name' => 'points',
                'readonly' => true,
                'label' => 'LBL_POINTS',
              ),
              7 => 
              array (
                'name' => 'momentum_score',
                'readonly' => true,
                'label' => 'LBL_MOMENTUM_SCORE',
              ),
              8 => 
              array (
                'name' => 'momentum_points',
                'readonly' => true,
                'label' => 'LBL_MOMENTUM_POINTS',
              ),
              9 => 
              array (
                'name' => 'state',
                'readonly' => true,
                'label' => 'LBL_STATE',
              ),
              10 => 
              array (
                'name' => 'sort_order',
                'readonly' => false,
                'label' => 'LBL_SORT_ORDER',
              ),
              11 => 
              array (
                'name' => 'description',
                'comment' => 'Full text of the note',
                'label' => 'LBL_DESCRIPTION',
              ),
              12 => 
              array (
                'name' => 'date_started',
                'readonly' => true,
                'label' => 'LBL_DATE_STARTED',
              ),
              13 => 
              array (
                'name' => 'date_completed',
                'readonly' => true,
                'label' => 'LBL_DATE_COMPLETED',
              ),
              14 => 'team_name',
              15 => 'assigned_user_name',
            ),
          ),
        ),
      ),
    ),
  ),
);
