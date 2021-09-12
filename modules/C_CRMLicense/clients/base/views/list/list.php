<?php
$module_name = 'C_CRMLicense';
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
                'name' => 'license_type',
                'label' => 'LBL_LICENSE_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'date_start',
                'label' => 'LBL_DATE_START',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'date_expired',
                'label' => 'LBL_DATE_EXPIRED',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'number_of_user',
                'label' => 'LBL_NUMBER_OF_USER',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'number_of_team',
                'label' => 'LBL_NUMBER_OF_TEAM',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'number_storage',
                'label' => 'LBL_NUMBER_STORAGE',
                'enabled' => true,
                'default' => true,
              ),
              7 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              8 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => true,
              ),
              9 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => false,
                'enabled' => true,
              ),
              10 => 
              array (
                'name' => 'date_entered',
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
