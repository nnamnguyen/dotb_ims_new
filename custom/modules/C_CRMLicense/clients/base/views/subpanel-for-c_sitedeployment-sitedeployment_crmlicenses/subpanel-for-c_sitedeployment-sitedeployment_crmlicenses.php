<?php
// created: 2021-04-08 15:08:43
$viewdefs['C_CRMLicense']['base']['view']['subpanel-for-c_sitedeployment-sitedeployment_crmlicenses'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
        0 => 
        array (
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
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
          'label' => 'LBL_DATE_MODIFIED',
          'enabled' => true,
          'default' => true,
          'name' => 'date_modified',
        ),
      ),
    ),
  ),
  'orderBy' => 
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
);