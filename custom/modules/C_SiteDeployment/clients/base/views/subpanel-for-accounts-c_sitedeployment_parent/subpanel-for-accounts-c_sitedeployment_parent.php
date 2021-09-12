<?php
// created: 2020-11-09 10:16:00
$viewdefs['C_SiteDeployment']['base']['view']['subpanel-for-accounts-c_sitedeployment_parent'] = array (
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
          'name' => 'site_url',
          'label' => 'LBL_SITE_URL',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'lic_users',
          'label' => 'LBL_LIC_USERS',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'date_start',
          'label' => 'LBL_DATE_START',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'date_expired',
          'label' => 'LBL_DATE_EXPIRED',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'lic_remain',
          'label' => 'LBL_LIC_REMAIN',
          'enabled' => true,
          'default' => true,
            'type' => 'html'
        ),
        7 => 
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'description',
          'label' => 'LBL_DESCRIPTION',
          'enabled' => true,
          'sortable' => false,
          'default' => true,
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