<?php
$module_name = 'J_Sponsor';
$viewdefs[$module_name] =
array (
  'DetailView' =>
  array (
    'templateMeta' =>
    array (
      'form' =>
      array (
        'buttons' =>
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
        ),
      ),
      'maxColumns' => '2',
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
      'tabDefs' =>
      array (
        'DEFAULT' =>
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' =>
    array (
      'default' =>
      array (
        0 =>
        array (
          0 => 'name',
          1 => 'voucher_code'
        ),
        1 =>
        array (
          0 =>
          array (
            'name' => 'sponsor_number',
            'label' => 'LBL_SPONSOR_NUMBER',
          ),
          1 =>
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        2 =>
        array (
          0 =>
          array (
            'name' => 'payment_name',
            'label' => 'LBL_PAYMENT_NAME',
          ),
          1 =>
          array (
            'name' => 'foc_type',
            'studio' => 'visible',
            'label' => 'LBL_FOC_TYPE',
          ),
        ),
        3 =>
        array (
          0 =>
          array (
            'name' => 'student_name',
          ),
          1 => 'loyalty_points'
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'discount_name',
            'label' => 'LBL_DISCOUNT_NAME',
          ),
          1 => array (
            'name' => 'amount',
          ),
        ),
        5 =>
        array (
          0 => array (
            'name' => 'total_down',
            'label' => 'LBL_DISCOUNT_SPONSOR_DOWN',
          ),
          1 =>
          array (
            'name' => 'percent',
          ),
        ),
        6 =>
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
