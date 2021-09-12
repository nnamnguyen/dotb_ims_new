<?php
$module_name = 'DRI_Workflows';
$viewdefs[$module_name] = 
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
                'name' => 'lead_name',
                'label' => 'LBL_LEAD',
                'enabled' => true,
                'default' => true,
              ),
              1 => 
              array (
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              2 => 
              array (
                'name' => 'progress',
                'label' => 'LBL_PROGRESS',
                'type' => 'cj_progress_bar',
                'enabled' => true,
                'default' => true,
                'related_fields' => 
                array (
                  0 => 'score',
                  1 => 'points',
                ),
              ),
              3 => 
              array (
                'name' => 'momentum_ratio',
                'label' => 'LBL_MOMENTUM_RATIO',
                'type' => 'cj_momentum_bar',
                'enabled' => true,
                'default' => true,
                'related_fields' => 
                array (
                  0 => 'momentum_score',
                  1 => 'momentum_points',
                ),
              ),
              4 => 
              array (
                'name' => 'current_stage_name',
                'label' => 'LBL_CURRENT_STAGE',
                'enabled' => true,
                'id' => 'CURRENT_STAGE_ID',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'parent_name',
                'label' => 'LBL_PARENT_NAME',
                'enabled' => true,
                'id' => 'PARENT_NAME',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              7 => 
              array (
                'label' => 'LBL_DATE_MODIFIED',
                'enabled' => true,
                'default' => true,
                'name' => 'date_modified',
                'readonly' => true,
              ),
              8 => 
              array (
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'name' => 'date_entered',
                'readonly' => true,
              ),
              9 => 
              array (
                'name' => 'account_name',
                'label' => 'LBL_ACCOUNT',
                'enabled' => true,
                'default' => false,
              ),
              10 => 
              array (
                'name' => 'contact_name',
                'label' => 'LBL_CONTACT',
                'enabled' => true,
                'id' => 'CONTACT_ID',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'case_name',
                'label' => 'LBL_CASE',
                'enabled' => true,
                'id' => 'CASE_ID',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'opportunity_name',
                'label' => 'LBL_OPPORTUNITY',
                'enabled' => true,
                'id' => 'OPPORTUNITY_ID',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              13 => 
              array (
                'name' => 'score',
                'label' => 'LBL_SCORE',
                'enabled' => true,
                'readonly' => true,
                'default' => false,
              ),
              14 => 
              array (
                'name' => 'points',
                'label' => 'LBL_POINTS',
                'enabled' => true,
                'readonly' => true,
                'default' => false,
              ),
              15 => 
              array (
                'name' => 'state',
                'label' => 'LBL_STATE',
                'enabled' => true,
                'readonly' => true,
                'default' => false,
              ),
              16 => 
              array (
                'name' => 'dri_workflow_template_name',
                'label' => 'LBL_DRI_WORKFLOW_TEMPLATE',
                'enabled' => true,
                'id' => 'DRI_WORKFLOW_TEMPLATE_ID',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              17 => 
              array (
                'name' => 'archived',
                'label' => 'LBL_ARCHIVED',
                'enabled' => true,
                'default' => false,
              ),
              18 => 
              array (
                'name' => 'created_by_name',
                'label' => 'LBL_CREATED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'CREATED_BY',
                'link' => true,
                'default' => false,
              ),
              19 => 
              array (
                'name' => 'modified_by_name',
                'label' => 'LBL_MODIFIED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'MODIFIED_USER_ID',
                'link' => true,
                'default' => false,
              ),
            ),
          ),
        ),
        'orderBy' => 
        array (
          'field' => 'date_modified',
          'direction' => 'desc',
        ),
      ),
    ),
  ),
);
