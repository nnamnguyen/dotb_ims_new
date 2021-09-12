<?php
// created: 2021-03-29 16:35:24
$viewdefs['C_SiteDeployment']['base']['view']['subpanel-for-leads-leads_sitedeployment'] = array (
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
          'name' => 'lic_type',
          'label' => 'LBL_LIC_TYPE',
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
          'name' => 'user_admin',
          'label' => 'LBL_USER_ADMIN',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'pass_admin',
          'label' => 'LBL_PASS_ADMIN',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'site_url',
          'label' => 'LBL_SITE_URL',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'date_start',
          'label' => 'LBL_DATE_START',
          'enabled' => true,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'date_expired',
          'label' => 'LBL_DATE_EXPIRED',
          'enabled' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'readonly' => true,
          'default' => true,
        ),
        9 => 
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