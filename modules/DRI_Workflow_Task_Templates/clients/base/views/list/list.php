<?php
$module_name = 'DRI_Workflow_Task_Templates';
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
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              1 =>
              array (
                'name' => 'dri_subworkflow_template_name',
                'label' => 'LBL_DRI_SUBWORKFLOW_TEMPLATE',
                'enabled' => true,
                'id' => 'DRI_SUBWORKFLOW_TEMPLATE_ID',
                'link' => true,
                'sortable' => true,
                'default' => true,
              ),
              2 =>
              array (
                'name' => 'dri_workflow_template_name',
                'label' => 'LBL_DRI_WORKFLOW_TEMPLATE',
                'enabled' => true,
                'readonly' => true,
                'id' => 'DRI_WORKFLOW_TEMPLATE_ID',
                'link' => true,
                'sortable' => true,
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'activity_type',
                'label' => 'LBL_ACTIVITY_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              4 =>
              array (
                'name' => 'priority',
                'label' => 'LBL_PRIORITY',
                'enabled' => true,
                'default' => true,
              ),
              5 =>
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
                'enabled' => true,
                'default' => true,
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
                'name' => 'created_by_name',
                'label' => 'LBL_CREATED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'CREATED_BY',
                'link' => true,
                'sortable' => false,
                'default' => false,
              ),
              10 =>
              array (
                'name' => 'task_due_days',
                'label' => 'LBL_TASK_DUE_DAYS',
                'enabled' => true,
                'default' => false,
              ),
              11 =>
              array (
                'name' => 'task_due_date_type',
                'label' => 'LBL_TASK_DUE_DATE_TYPE',
                'enabled' => true,
                'default' => false,
              ),
              12 =>
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
