<?php
$module_name = 'J_PaymentDetail';
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
                'name' => 'parent_name',
                'label' => 'LBL_LIST_RELATED_TO',
                'enabled' => true,
                'id' => 'parent_id',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              1 => 
              array (
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              2 =>array (
                  'name' => 'quote_name',
                  'label' => 'LBL_QUOTE_NAME',
                  'enabled' => true,
                  'id' => 'QUOTE_ID',
                  'link' => true,
                  'sortable' => false,
                  'default' => true,
              ),
              3 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
                'width' => 'xlarge',
              ),
              4 => 
              array (
                'name' => 'payment_date',
                'label' => 'LBL_PAYMENT_DATE',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'payment_amount',
                'label' => 'LBL_PAYMENT_AMOUNT',
                'enabled' => true,
                'currency_format' => true,
                'default' => true,
              ),
                6 =>
                    array (
                        'name' => 'payment_type',
                        'label' => 'LBL_PAYMENT_TYPE',
                        'enabled' => true,
                        'default' => true,
                        'type' =>'event-status'
                    ),
              7 =>
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => true,
                  'type' =>'event-status'
              ),
              8 =>
              array (
                'name' => 'pos_code',
                'label' => 'LBL_POS_CODE',
                'enabled' => true,
                'default' => true,
              ),
              9 =>
              array (
                'name' => 'payment_method',
                'label' => 'LBL_PAYMENT_METHOD',
                'enabled' => true,
                'default' => true,
              ),
              10 =>
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              11 =>
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => true,
                'enabled' => true,
              ),
              12 =>
              array (
                'name' => 'inv_code',
                'label' => 'LBL_INV_CODE',
                'enabled' => true,
                'default' => false,
              ),
              13 =>
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
              14 =>
              array (
                'name' => 'date_entered',
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
