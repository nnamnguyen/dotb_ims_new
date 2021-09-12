<?php
$module_name = 'J_Sponsor';
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
                'name' => 'amount',
                'label' => 'LBL_AMOUNT',
                'enabled' => true,
                'currency_format' => true,
                'default' => true,
              ),
              2 =>
              array (
                'name' => 'percent',
                'label' => 'LBL_PERCENT',
                'enabled' => true,
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'type',
                'label' => 'LBL_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              4 =>
              array (
                'name' => 'foc_type',
                'label' => 'LBL_FOC_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              5 =>
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              6 =>
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => true,
                'enabled' => true,
              ),
              7 =>
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => true,
              ),
              8 =>
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => false,
              ),
              9 =>
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
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
