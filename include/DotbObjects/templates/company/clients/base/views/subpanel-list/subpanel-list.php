<?php

$module_name = '<module_name>';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array(
  'panels' => 
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array(
        array(
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
          'label' => 'LBL_INDUSTRY',
          'enabled' => true,
          'default' => true,
          'name' => 'industry',
        ),
        array(
          'label' => 'LBL_PHONE_OFFICE',
          'enabled' => true,
          'default' => true,
          'name' => 'phone_office',
        ),
        array(
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_ASSIGNED_USER',
          'enabled' => true,
          'default' => true,
        ),
      ),
    ),
  ),
);
