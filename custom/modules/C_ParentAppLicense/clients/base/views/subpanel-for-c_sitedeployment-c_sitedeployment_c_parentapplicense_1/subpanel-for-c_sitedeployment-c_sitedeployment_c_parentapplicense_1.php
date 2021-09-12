<?php
// created: 2020-09-25 17:58:06
$viewdefs['C_ParentAppLicense']['base']['view']['subpanel-for-c_sitedeployment-c_sitedeployment_c_parentapplicense_1'] = array (
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
          'name' => 'total',
          'label' => 'LBL_TOTAL',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'used',
          'label' => 'LBL_USED',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'package',
          'label' => 'LBL_PACKEAGE_LICENSE',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'start',
          'label' => 'LBL_DATE_START',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'expired',
          'label' => 'LBL_EXPIRED',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
          'type' => 'event-status',
        ),
        7 => 'package',
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