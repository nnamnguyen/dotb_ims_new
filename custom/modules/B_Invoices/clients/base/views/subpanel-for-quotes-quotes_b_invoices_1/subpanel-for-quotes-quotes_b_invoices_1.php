<?php
// created: 2020-11-09 16:10:08
$viewdefs['B_Invoices']['base']['view']['subpanel-for-quotes-quotes_b_invoices_1'] = array (
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
          'name' => 'ehd_id',
          'label' => 'LBL_EHD_ID',
          'enabled' => true,
          'default' => true,
        ),
        2 => 
        array (
          'name' => 'invoice_type',
          'label' => 'LBL_INVOICE_TYPE',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'total',
          'label' => 'LBL_TOTAL',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
        ),
        5 => 
        array (
          'name' => 'invoice_date',
          'label' => 'LBL_INVOICE_DATE',
          'enabled' => true,
          'default' => true,
        ),
        6 => 
        array (
          'name' => 'due_date',
          'label' => 'LBL_DUE_DATE',
          'enabled' => true,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'assigned_user_name',
          'label' => 'LBL_ASSIGNED_TO',
          'enabled' => true,
          'id' => 'ASSIGNED_USER_ID',
          'link' => true,
          'default' => true,
        ),
        8 => 
        array (
          'name' => 'team_name',
          'label' => 'LBL_TEAMS',
          'enabled' => true,
          'id' => 'TEAM_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        9 => 
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
  'type' => 'subpanel-list',
);