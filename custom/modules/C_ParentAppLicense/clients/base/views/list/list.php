<?php
$module_name = 'C_ParentAppLicense';
$viewdefs[$module_name] =
array (
  'base' =>
  array (
    'view' =>
    array (
      'list' =>
      array (
        'panels' =>
        array (
          0 =>
          array (
            'label' => 'LBL_PANEL_1',
            'fields' =>
            array (
              0 =>
              array (
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              1 =>
              array (
                'name' => 'total',
                'label' => 'LBL_TOTAL',
                'enabled' => true,
                'default' => true,
              ),
              2 =>
              array (
                'name' => 'used',
                'label' => 'LBL_USED',
                'enabled' => true,
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => true,
                'type'=>'event-status'
              ),
              4 =>
              array (
                'name' => 'expired',
                'label' => 'LBL_EXPIRED',
                'enabled' => true,
                'default' => true,
              ),
              5 =>
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => true,
              ),
              6 =>
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => false,
                'enabled' => true,
              ),
            ),
          ),
        ),
        'orderBy' =>
        array (
          'field' => 'date_modified',
          'direction' => 'desc',
        ),
      ),
    ),
  ),
);
