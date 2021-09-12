<?php
$module_name = 'C_ParentAppLicense';
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
      'popup_module' => 'C_ParentAppLicense',
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
    'total' => 
    array (
      'type' => 'int',
      'default' => true,
      'vname' => 'LBL_TOTAL',
      'width' => 10,
    ),
    'used' => 
    array (
      'type' => 'int',
      'default' => true,
      'vname' => 'LBL_USED',
      'width' => 10,
    ),
    'expired' => 
    array (
      'type' => 'date',
      'vname' => 'LBL_EXPIRED',
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
    'edit_button' => 
    array (
      'vname' => 'LBL_EDIT_BUTTON',
      'widget_class' => 'SubPanelEditButton',
      'module' => 'C_ParentAppLicense',
      'width' => '4%',
    ),
    'remove_button' => 
    array (
      'vname' => 'LBL_REMOVE',
      'widget_class' => 'SubPanelRemoveButton',
      'module' => 'C_ParentAppLicense',
      'width' => '5%',
    ),
  ),
);
