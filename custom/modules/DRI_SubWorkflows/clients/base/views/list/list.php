<?php
$module_name = 'DRI_SubWorkflows';
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
                'name' => 'dri_workflow_name',
                'label' => 'LBL_DRI_WORKFLOW',
                'enabled' => true,
                'id' => 'DRI_WORKFLOW_ID',
                'link' => true,
                'sortable' => false,
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
                'name' => 'state',
                'label' => 'LBL_STATE',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
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
              4 => 
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
              5 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              6 => 
              array (
                'label' => 'LBL_DATE_MODIFIED',
                'enabled' => true,
                'default' => true,
                'name' => 'date_modified',
                'readonly' => true,
              ),
              7 => 
              array (
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'name' => 'date_entered',
                'readonly' => true,
              ),
              8 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => false,
                'enabled' => true,
              ),
              9 => 
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
                'enabled' => true,
                'default' => false,
              ),
              10 => 
              array (
                'name' => 'modified_by_name',
                'label' => 'LBL_MODIFIED_NAME',
                'enabled' => true,
                'readonly' => true,
                'id' => 'MODIFIED_USER_ID',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'dri_subworkflow_template_name',
                'label' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
                'enabled' => true,
                'id' => 'DRI_SUBWORKFLOW_TEMPLATE_ID',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'created_by_name',
                'label' => 'LBL_CREATED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'CREATED_BY',
                'link' => true,
                'sortable' => false,
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
