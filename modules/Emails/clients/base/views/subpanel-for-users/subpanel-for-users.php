<?php

$viewdefs['Emails']['base']['view']['subpanel-for-users'] = array(
  'type' => 'subpanel-list',
  'panels' =>
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'label' => 'LBL_LIST_SUBJECT',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
        ),
        array(
          'label' => 'LBL_LIST_STATUS',
          'enabled' => true,
          'default' => true,
          'name' => 'state',
        ),
        array(
          'target_record_key' => 'contact_id',
          'target_module' => 'Contacts',
          'label' => 'LBL_LIST_CONTACT',
          'enabled' => true,
          'default' => true,
          'name' => 'contact_name',
        ),
        array(
          'enabled' => true,
          'default' => true,
          'name' => 'date_modified',
          'readonly' => true
        ),
        array(
          'enabled' => true,
          'default' => true,
          'name' => 'date_entered',
          'readonly' => true
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
