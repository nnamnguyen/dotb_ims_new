<?php
$module_name = 'DRI_Workflows';
$viewdefs[$module_name] = 
array (
  'mobile' => 
  array (
    'view' => 
    array (
      'edit' => 
      array (
        'templateMeta' => 
        array (
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
              0 => 
              array (
                'name' => 'name',
                'readonly' => true,
                'label' => 'LBL_NAME',
              ),
              1 => 'dri_workflow_template_name',
              2 => 'available_modules',
              3 => 'parent_name',
              4 => 
              array (
                'name' => 'progress',
                'type' => 'cj_progress_bar',
              ),
              5 => 'assignee_rule',
              6 => 'target_assignee',
              7 => 'current_stage_name',
              8 => 'score',
              9 => 'points',
              10 => 'state',
              11 => 'account_name',
              12 => 'contact_name',
              13 => 'lead_name',
              14 => 'opportunity_name',
              15 => 'case_name',
              16 => 
              array (
                'name' => 'description',
                'span' => 12,
              ),
              17 => 'team_name',
              18 => 'assigned_user_name',
              19 => 'date_modified',
              20 => 'modified_by_name',
              21 => 'date_entered',
              22 => 'created_by_name',
              23 => 
              array (
                'name' => 'tag',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
