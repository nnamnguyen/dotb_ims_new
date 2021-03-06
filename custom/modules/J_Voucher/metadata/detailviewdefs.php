<?php
$module_name = 'J_Voucher';
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
          1 =>
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
        ),
        1 =>
        array (
          0 =>
          array (
            'name' => 'discount_amount',
            'label' => 'LBL_DISCOUNT_AMOUNT',
          ),
          1 =>
          array (
            'name' => 'foc_type',
            'studio' => 'visible',
            'label' => 'LBL_FOC_TYPE',
          ),
        ),
        2 =>
        array (
          0 =>
          array (
            'name' => 'discount_percent',
            'label' => 'LBL_DISCOUNT_PERCENT',
          ),
          1 =>
          array (
            'name' => 'used_time',
            'studio' => 'visible',
            'label' => 'LBL_USED_TIME',
            'customCode' => '{$fields.used_time.value} / {$fields.use_time.value}',
          ),
        ),
        3 =>
        array (
          0 =>
          array (
            'name' => 'use_time',
            'studio' => 'visible',
            'label' => 'LBL_USE_TIME',
          ),
          1 =>
          array (
            'name' => 'start_date',
            'label' => 'LBL_START_DATE',
          ),
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'description',
            'customCode' => '{$fields.description.value}{$student_link}',
          ),
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'team_name',
          ),
          1 =>
          array (
            'name' => 'end_date',
            'label' => 'LBL_END_DATE',
          ),
        ),
        5 =>
        array (
          0 => 'assigned_user_name',
          1 =>
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
        ),
      ),
    ),
  ),
);
