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
          'label' => 'LBL_SUBJECT',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
          'name' => 'status',
        ),
        array(
          'label' => 'LBL_RESOLUTION',
          'enabled' => true,
          'default' => true,
          'name' => 'resolution',
        ),
        array(
          'label' => 'LBL_PRIORITY',
          'enabled' => true,
          'default' => true,
          'name' => 'priority',
        ),
        array(
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_ASSIGNED_TO_NAME',
          'enabled' => true,
          'default' => true,
        ),
      ),
    ),
  ),
);
