<?php

$viewdefs['Cases']['base']['view']['subpanel-for-accounts'] = array(
  'type' => 'subpanel-list',
  'panels' =>
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'label' => 'LBL_LIST_NUMBER',
          'enabled' => true,
          'default' => true,
          'readonly' => true,
          'name' => 'case_number',
        ),
        array(
          'label' => 'LBL_LIST_SUBJECT',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
          'label' => 'LBL_LIST_STATUS',
          'enabled' => true,
          'default' => true,
          'name' => 'status',
        ),
        array(
          'label' => 'LBL_LIST_PRIORITY',
          'enabled' => true,
          'default' => true,
          'name' => 'priority',
        ),
        array(
          'label' => 'LBL_LIST_DATE_CREATED',
          'enabled' => true,
          'default' => true,
          'name' => 'date_entered',
        ),
        array(
          'name' => 'assigned_user_name',
          'target_record_key' => 'assigned_user_id',
          'target_module' => 'Employees',
          'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
          'enabled' => true,
          'default' => true,
        ),
      ),
    ),
  ),
);
