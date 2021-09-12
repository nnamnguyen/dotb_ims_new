<?php
// created: 2020-08-24 10:06:03
$subpanel_layout['list_fields'] = array (
  'name' =>
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'type' =>
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => 10,
  ),
  'discount_percent' =>
  array (
    'type' => 'decimal',
    'vname' => 'LBL_DISCOUNT_PERCENT',
    'width' => 10,
    'default' => true,
  ),
  'discount_amount' =>
  array (
    'type' => 'decimal',
    'vname' => 'LBL_DISCOUNT_AMOUNT',
    'width' => 10,
    'default' => true,
  ),
  'status' =>
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => 10,
  ),
  'start_date' =>
  array (
    'type' => 'date',
    'vname' => 'LBL_START_DATE',
    'width' => 10,
    'default' => true,
  ),
  'end_date' =>
  array (
    'type' => 'date',
    'vname' => 'LBL_END_DATE',
    'width' => 10,
    'default' => true,
  ),
  'date_modified' =>
  array (
    'type' => 'datetime',
    'studio' =>
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => 10,
    'default' => true,
  ),
      'remove_button'=>array(
        'vname' => 'LBL_REMOVE',
        'widget_class' => 'SubPanelRemoveButton',
        'module' => 'J_Discount',
        'width' => '1%',
    ),
);