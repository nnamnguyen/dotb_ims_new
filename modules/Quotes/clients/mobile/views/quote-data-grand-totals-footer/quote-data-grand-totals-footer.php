<?php

$viewdefs['Quotes']['mobile']['view']['quote-data-grand-totals-footer'] = array(
    'panels' => array(
        array(
            'name' => 'panel_quote_data_grand_totals_footer',
            'fields' => array(
                array(
                    'name' => 'deal_tot',
                    'type' => 'currency',
                    'related_fields' => array(
                        'deal_tot_discount_percentage',
                    ),
                    'label' => 'LBL_LIST_DEAL_TOT',
                ),
                array(
                    'name' => 'new_sub',
                    'type' => 'currency',
                    'label' => 'LBL_NEW_SUB',
                ),
                array(
                    'name' => 'tax',
                    'type' => 'currency',
                    'related_fields' => array(
                        'taxrate_value',
                    ),
                    'label' => 'LBL_TAX',
                ),
                array(
                    'name' => 'shipping',
                    'type' => 'currency',
                    'default' => '0.00',
                    'label' => 'LBL_SHIPPING',
                ),
                array(
                    'name' => 'total',
                    'label' => 'LBL_LIST_GRAND_TOTAL',
                    'type' => 'currency',
                ),
            ),
        ),
    ),
);
