<?php
$module_name = 'DRI_SubWorkflows';
$viewdefs[$module_name] = 
array (
  'mobile' => 
  array (
    'view' => 
    array (
      'list' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'label' => 'LBL_PANEL_DEFAULT',
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
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'width' => '9',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              2 => 
              array (
                'name' => 'progress',
                'label' => 'LBL_PROGRESS',
                'enabled' => true,
                'readonly' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'state',
                'label' => 'LBL_STATE',
                'enabled' => true,
                'readonly' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'width' => '9',
                'default' => true,
                'enabled' => true,
              ),
              5 => 
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
                'enabled' => true,
                'readonly' => false,
                'default' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
