<?php
$viewdefs['DRI_Workflow_Templates'] = 
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
                'name' => 'active',
                'label' => 'LBL_ACTIVE',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'available_modules',
                'label' => 'LBL_AVAILABLE_MODULES',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'related_activities',
                'label' => 'LBL_RELATED_ACTIVITIES',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'points',
                'label' => 'LBL_POINTS',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'label' => 'LBL_DATE_MODIFIED',
                'enabled' => true,
                'default' => true,
                'name' => 'date_modified',
                'readonly' => true,
              ),
              6 => 
              array (
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'name' => 'date_entered',
                'readonly' => true,
              ),
              7 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => false,
                'enabled' => true,
              ),
              8 => 
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
              9 => 
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
              10 => 
              array (
                'name' => 'assignee_rule',
                'label' => 'LBL_ASSIGNEE_RULE',
                'enabled' => true,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'target_assignee',
                'label' => 'LBL_TARGET_ASSIGNEE',
                'enabled' => true,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'copied_template_name',
                'label' => 'LBL_COPIED_TEMPLATE',
                'enabled' => true,
                'id' => 'COPIED_TEMPLATE_ID',
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
