<?php
// created: 2020-10-24 16:55:57
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
    'link' => true,
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
  'currency_id' => 
  array (
    'name' => 'currency_id',
    'usage' => 'query_only',
  ),
  'payment_amount' => 
  array (
    'name' => 'payment_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'paid_amount' => 
  array (
    'name' => 'paid_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'deposit_amount' => 
  array (
    'name' => 'deposit_amount',
    'usage' => 'query_only',
    'sortable' => false,
  ),
  'contract_id' => 
  array (
    'name' => 'contract_id',
    'usage' => 'query_only',
  ),
  'description' => 
  array (
    'name' => 'description',
    'usage' => 'query_only',
  ),
);