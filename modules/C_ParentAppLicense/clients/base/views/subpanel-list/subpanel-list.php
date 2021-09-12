<?php
// created: 2020-09-21 11:04:20
$viewdefs['C_ParentAppLicense']['base']['view']['subpanel-list'] = array (
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
          'name' => 'expired',
          'label' => 'LBL_EXPIRED',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'date_entered',
          'label' => 'LBL_DATE_ENTERED',
          'enabled' => true,
          'readonly' => true,
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
);