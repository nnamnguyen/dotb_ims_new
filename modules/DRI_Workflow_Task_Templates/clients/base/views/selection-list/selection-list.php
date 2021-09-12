<?php
$viewdefs['DRI_Workflow_Task_Templates'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'selection-list' => 
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
                'sortable' => false,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'activity_type',
                'label' => 'LBL_ACTIVITY_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'type',
                'label' => 'LBL_TYPE',
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
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'readonly' => true,
                'default' => false,
              ),
              8 => 
              array (
                'name' => 'task_due_date_type',
                'label' => 'LBL_TASK_DUE_DATE_TYPE',
                'enabled' => true,
                'default' => false,
              ),
              9 => 
              array (
                'name' => 'points',
                'label' => 'LBL_POINTS',
                'enabled' => true,
                'default' => false,
              ),
              10 => 
              array (
                'name' => 'duration_minutes',
                'label' => 'LBL_DURATION_MINUTES',
                'enabled' => true,
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
