<?php
// created: 2020-02-09 13:16:10
$viewdefs['J_Loyalty']['base']['view']['subpanel-for-contacts-loyalty_link'] = array (
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
          'name' => 'name',
          'label' => 'LBL_NAME',
          'enabled' => true,
          'link' => true,
          'default' => true,
        ),
        1 =>
        array (
          'name' => 'input_date',
          'label' => 'LBL_INPUT_DATE',
          'enabled' => true,
          'default' => true,
        ),
        2 =>
        array (
          'name' => 'type',
          'label' => 'LBL_TYPE',
          'enabled' => true,
          'default' => true,
          'type' => 'html',
        ),
        3 =>
        array (
          'name' => 'point',
          'label' => 'LBL_POINT',
          'enabled' => true,
          'default' => true,
          'type' => 'html',
        ),
        4 =>
        array (
          'name' => 'exp_date',
          'label' => 'LBL_EXP_DATE',
          'enabled' => true,
          'default' => true,
        ),
        5 =>
        array (
          'name' => 'j_class_j_loyalty_1_name',
          'label' => 'LBL_J_CLASS_J_LOYALTY_1_FROM_J_CLASS_TITLE',
          'enabled' => true,
          'id' => 'J_CLASS_J_LOYALTY_1J_CLASS_IDA',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        6 =>
        array (
          'name' => 'payment_name',
          'label' => 'LBL_PAYMENT_NAME',
          'enabled' => true,
          'id' => 'PAYMENT_ID',
          'link' => true,
          'sortable' => false,
          'default' => true,
        ),
        7 =>
        array (
          'name' => 'description',
          'label' => 'LBL_DESCRIPTION',
          'enabled' => true,
          'sortable' => false,
          'default' => true,
          'width' => 'large',
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
          'name' => 'created_by_name',
          'label' => 'LBL_CREATED',
          'enabled' => true,
          'readonly' => true,
          'id' => 'CREATED_BY',
          'link' => true,
          'default' => true,
        ),
      ),
    ),
  ),
  'orderBy' =>
  array (
    'field' => 'input_date',
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