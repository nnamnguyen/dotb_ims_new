<?php
// created: 2019-10-14 05:14:27
$viewdefs['J_Payment']['base']['view']['subpanel-for-j_payment-j_payment_j_payment_2'] = array (
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
          'name' => 'contacts_j_payment_1_name',
          'label' => 'LBL_CONTACTS_J_PAYMENT_1_FROM_CONTACTS_TITLE',
          'enabled' => true,
          'id' => 'CONTACTS_J_PAYMENT_1CONTACTS_IDA',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'phone',
          'label' => 'LBL_PHONE',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'payment_type',
          'label' => 'LBL_PAYMENT_TYPE',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'payment_date',
          'label' => 'LBL_PAYMENT_DATE',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_ASSIGNED_TO',
          'enabled' => true,
          'id' => 'ASSIGNED_USER_ID',
          'link' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
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