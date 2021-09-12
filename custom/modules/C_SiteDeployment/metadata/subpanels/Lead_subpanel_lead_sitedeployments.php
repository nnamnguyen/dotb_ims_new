<?php
// created: 2021-04-08 10:27:54
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'site_url' => 
  array (
    'type' => 'url',
    'default' => true,
    'vname' => 'LBL_SITE_URL',
    'width' => 10,
  ),
  'status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_STATUS',
    'width' => 10,
  ),
  'date_start' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DATE_START',
    'width' => 10,
    'default' => true,
  ),
  'date_expired' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DATE_EXPIRED',
    'width' => 10,
    'default' => true,
  ),
  'lic_remain' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_LIC_REMAIN',
    'width' => 10,
    'default' => true,
  ),
  'lic_users' => 
  array (
    'type' => 'int',
    'vname' => 'LBL_LIC_USERS',
    'width' => 10,
    'default' => true,
  ),
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
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
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => 10,
    'default' => true,
  ),
);