<?php
// created: 2021-03-29 16:35:21
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => 10,
    'default' => true,
  ),
  'lic_type' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_LIC_TYPE',
    'width' => 10,
    'default' => true,
  ),
  'status' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_STATUS',
    'width' => 10,
  ),
  'user_admin' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_USER_ADMIN',
    'width' => 10,
    'default' => true,
  ),
  'pass_admin' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_PASS_ADMIN',
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