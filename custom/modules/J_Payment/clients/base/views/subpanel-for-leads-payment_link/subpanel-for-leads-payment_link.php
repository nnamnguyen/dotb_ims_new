<?php
// created: 2019-04-18 22:37:36
$viewdefs['J_Payment']['base']['view']['subpanel-for-leads-payment_link'] = array (
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
          'name' => 'payment_type',
          'label' => 'LBL_PAYMENT_TYPE',
          'enabled' => true,
          'default' => true,
          'type' => 'html',
        ),
        2 =>
        array (
          'name' => 'sale_type',
          'label' => 'LBL_SALE_TYPE',
          'enabled' => true,
          'default' => true,
        ),
        3 =>
        array (
          'name' => 'payment_date',
          'label' => 'LBL_PAYMENT_DATE',
          'enabled' => true,
          'default' => true,
        ),
        4 =>
        array (
          'name' => 'payment_amount',
          'label' => 'LBL_GRAND_TOTAL',
          'enabled' => true,
          'related_fields' =>
          array (
            0 => 'currency_id',
            1 => 'base_rate',
          ),
          'currency_format' => true,
          'default' => true,
        ),
        5 =>
        array (
          'name' => 'related_payment_detail',
          'label' => 'LBL_PAYMENT_DETAIL',
          'enabled' => true,
          'default' => true,
          'width' => 'xlarge',
          'type' => 'html',
        ),
        6 =>
        array (
          'name' => 'remain_amount',
          'label' => 'LBL_REMAIN_AMOUNT',
          'enabled' => true,
          'related_fields' =>
          array (
            0 => 'currency_id',
            1 => 'base_rate',
          ),
          'currency_format' => true,
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
      ),
    ),
  ),
  'orderBy' =>
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
    'rowactions' =>
  array (
    'actions' =>
    array (
      0 =>
      array (
        'type' => 'rowaction',
        'css_class' => 'btn',
        'tooltip' => 'LBL_PREVIEW',
        'event' => 'list:preview:fire',
        'icon' => 'fa-search-plus',
        'acl_action' => 'view',
      ),
    ),
  ),
);