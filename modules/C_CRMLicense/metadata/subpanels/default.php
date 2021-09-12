<?php
$module_name = 'C_CRMLicense';
$subpanel_layout = 
array (
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'popup_module' => 'C_CRMLicense',
    ),
  ),
  'where' => '',
  'list_fields' => 
  array (
    'name' => 
    array (
      'vname' => 'LBL_NAME',
      'widget_class' => 'SubPanelDetailViewLink',
      'width' => 10,
      'default' => true,
    ),
    'license_type' => 
    array (
      'type' => 'enum',
      'default' => true,
      'vname' => 'LBL_LICENSE_TYPE',
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
    'number_of_user' => 
    array (
      'type' => 'int',
      'default' => true,
      'vname' => 'LBL_NUMBER_OF_USER',
      'width' => 10,
    ),
    'number_of_team' => 
    array (
      'type' => 'int',
      'default' => true,
      'vname' => 'LBL_NUMBER_OF_TEAM',
      'width' => 10,
    ),
    'number_storage' => 
    array (
      'type' => 'int',
      'default' => true,
      'vname' => 'LBL_NUMBER_STORAGE',
      'width' => 10,
    ),
    'date_modified' => 
    array (
      'vname' => 'LBL_DATE_MODIFIED',
      'width' => 10,
      'default' => true,
    ),
    'edit_button' => 
    array (
      'vname' => 'LBL_EDIT_BUTTON',
      'widget_class' => 'SubPanelEditButton',
      'module' => 'C_CRMLicense',
      'width' => '4%',
    ),
    'remove_button' => 
    array (
      'vname' => 'LBL_REMOVE',
      'widget_class' => 'SubPanelRemoveButton',
      'module' => 'C_CRMLicense',
      'width' => '5%',
    ),
  ),
);
