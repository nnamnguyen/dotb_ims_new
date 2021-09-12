<?php
// created: 2020-02-09 13:16:10
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'input_date' => 
  array (
    'vname' => 'LBL_INPUT_DATE',
    'width' => 10,
    'default' => true,
  ),
  'type' => 
  array (
    'vname' => 'LBL_TYPE',
    'width' => 10,
    'default' => true,
  ),
  'point' => 
  array (
    'vname' => 'LBL_POINT',
    'width' => 10,
    'default' => true,
  ),
  'exp_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_EXP_DATE',
    'width' => 10,
    'default' => true,
  ),
  'j_class_j_loyalty_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_J_CLASS_J_LOYALTY_1_FROM_J_CLASS_TITLE',
    'id' => 'J_CLASS_J_LOYALTY_1J_CLASS_IDA',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'J_Class',
    'target_record_key' => 'j_class_j_loyalty_1j_class_ida',
  ),
  'payment_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_PAYMENT_NAME',
    'id' => 'PAYMENT_ID',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'J_Payment',
    'target_record_key' => 'payment_id',
  ),
  'description' => 
  array (
    'vname' => 'LBL_DESCRIPTION',
    'width' => 10,
    'default' => true,
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'portaleditview' => false,
    ),
    'readonly' => true,
    'vname' => 'LBL_DATE_ENTERED',
    'width' => 10,
    'default' => true,
  ),
  'created_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => 10,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'created_by',
  ),
);