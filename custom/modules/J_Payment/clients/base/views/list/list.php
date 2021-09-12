<?php
$module_name = 'J_Payment';
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
                'width' => 'large',
              ),
              1 =>
              array (
                'name' => 'parent_name',
              ),
              2 =>
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => true,
                'type' => 'event-status',
              ),
              3 =>
              array (
                'name' => 'payment_type',
                'label' => 'LBL_PAYMENT_TYPE',
                'enabled' => true,
                'default' => true,
                'type' => 'event-status',
                'width' => 'large',
              ),
              4 =>
              array (
                'name' => 'payment_amount',
                'label' => 'LBL_GRAND_TOTAL',
                'enabled' => true,
                'related_fields' =>
                array (
                  0 => 'currency_id',
                  1 => 'base_rate',
                ),
                'currency_format' => true,
                'default' => true,
              ),
//              5 =>
//              array (
//                'name' => 'amount_bef_discount',
//                'enabled' => true,
//                'default' => true,
//              ),
              6 =>
              array (
                'name' => 'remain_amount',
                'label' => 'LBL_REMAIN_AMOUNT',
                'enabled' => true,
                'related_fields' =>
                array (
                  0 => 'currency_id',
                  1 => 'base_rate',
                ),
                'currency_format' => true,
                'default' => true,
                'width' => 'small',
              ),
                7 =>
                    array (
                        'name' => 'total_quantity',
                        'label' => 'LBL_TOTAL_QUANTITY',
                        'enabled' => true,
                        'default' => true,
                    ),
              8 =>
              array (
                'name' => 'remain_quantity',
                'label' => 'LBL_REMAIN_QUANTITY',
                'enabled' => true,
                'default' => true,
              ),
              9 =>
              array (
                'name' => 'limit_quantity',
                'enabled' => true,
                'default' => true,
              ),
                    10 =>
                        array (
                            'name' => 'product_name',
                            'enabled' => true,
                            'default' => true,
                        ),
                11 =>
                    array (
                        'name' => 'unit_name',
                        'enabled' => true,
                        'default' => true,
                    ),
              12 =>
              array (
                'name' => 'sale_type',
                'label' => 'LBL_SALE_TYPE',
                'enabled' => true,
                'default' => true,
                'width' => 'small',
              ),
              13 =>
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              14 =>
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => true,
                'enabled' => true,
              ),
              15 =>
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => false,
              ),
              16 =>
              array (
                'name' => 'old_student_id',
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
