<?php
$module_name = 'DRI_SubWorkflows';
$viewdefs[$module_name] = 
array (
  'mobile' => 
  array (
    'view' => 
    array (
      'edit' => 
      array (
        'templateMeta' => 
        array (
          'maxColumns' => '1',
          'widths' => 
          array (
            0 => 
            array (
              'label' => '10',
              'field' => '30',
            ),
            1 => 
            array (
              'label' => '10',
              'field' => '30',
            ),
          ),
          'useTabs' => false,
        ),
        'panels' => 
        array (
          0 => 
          array (
            'label' => 'LBL_PANEL_DEFAULT',
            'newTab' => false,
            'panelDefault' => 'expanded',
            'name' => 'LBL_PANEL_DEFAULT',
            'columns' => '1',
            'labelsOnTop' => 1,
            'placeholders' => 1,
            'fields' => 
            array (
              0 => 'assigned_user_name',
              1 => 'team_name',
            ),
          ),
        ),
      ),
    ),
  ),
);
