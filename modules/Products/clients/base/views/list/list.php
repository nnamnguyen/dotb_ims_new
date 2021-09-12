<?php



$viewdefs['Products']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'link' => true,
                    'label' => 'LBL_NAME',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'account_name',
                    'label' => 'LBL_ACCOUNT_NAME',
                    'related_fields' => array('account_id'),
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                ),
                array(
                    'name' => 'quote_name',
                    'link' => true,
                    'label' => 'LBL_ASSOCIATED_QUOTE',
                    'related_fields' => array('quote_id'),
                    'enabled' => true,
                    'default' => true,
                ),
                'quantity',
                 array(
                    'name' => 'discount_price',
                    'type' => 'currency',
                    'related_fields' => array(
                        'discount_price',
                        'currency_id',
                        'base_rate',
                    ),
                    'convertToBase' => true,
                    'showTransactionalAmount' => true,
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                ),
                array(
                    'name' => 'cost_price',
                    'type' => 'currency',
                    'related_fields' => array(
                        'cost_price',
                        'currency_id',
                        'base_rate',
                    ),
                    'convertToBase' => true,
                    'showTransactionalAmount' => true,
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                ),
                array(
                    'name' => 'discount_amount',
                    'type' => 'discount',
                    'related_fields' => array(
                        'discount_select',
                        'currency_id',
                        'base_rate',
                    ),
                    'convertToBase' => true,
                    'showTransactionalAmount' => true,
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                ),
                array(
                    'name' => 'assigned_user_name',
                )
            ),
        ),
    )
);
