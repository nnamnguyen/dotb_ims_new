<?php
$module_name = 'J_Loyalty';
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
                'name' => 'parent_name',
              ),
              2 =>
              array (
                'name' => 'payment_name',
                'label' => 'LBL_PAYMENT_NAME',
                'enabled' => true,
                'id' => 'PAYMENT_ID',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'type',
                'label' => 'LBL_TYPE',
                'enabled' => true,
                'default' => true,
                'type' => 'html',
              ),
              4 =>
              array (
                'name' => 'point',
                'label' => 'LBL_POINT',
                'enabled' => true,
                'default' => true,
                'type' => 'html',
              ),
              5 =>
              array (
                'name' => 'input_date',
                'label' => 'LBL_INPUT_DATE',
                'enabled' => true,
                'default' => true,
              ),
              6 =>
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
              ),
              7 =>
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => true,
                'enabled' => true,
              ),
              8 =>
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => true,
              ),
              9 =>
              array (
                'name' => 'exp_date',
                'label' => 'LBL_EXP_DATE',
                'enabled' => true,
                'default' => false,
              ),
              10 =>
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
              11 =>
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => false,
                'enabled' => true,
                'link' => true,
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
