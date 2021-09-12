<?php

$viewdefs['Quotes']['base']['view']['quote-data-grand-totals-footer'] = array(
    'panels' => array(
        array(
            'name' => 'panel_quote_data_grand_totals_footer',
            'label' => 'LBL_QUOTE_DATA_GRAND_TOTALS_FOOTER',
            'fields' => array(
                array(
                    'name' => 'new_sub',
                    'type' => 'currency',
                ),
                // comment by nnamnguyen
                // array(
                //     'name' => 'session_discount',
                //     'css_class' => 'choose_discount_amount',
                //     'label' =>'LBL_ORDER_DISCOUNT',
                //     'type' => 'discount_icon',
                //     'fields' => array(
                //         array(
                //             'name' => 'order_discount_percent',
                //             'type' => 'discount',
                //             'convertToBase' => true,
                //             'showTransactionalAmount' => true,
                //             'percent' => 'true',
                //             'dismiss_label' => true,
                //             'session' => true
                //         ),
                //         array(
                //             'name' => 'order_discount_amount',
                //             'type' => 'currency',
                //             'dismiss_label' => true,
                //             'session' => true
                //         ),
                //         array(
                //             'name' => 'discount_detail',
                //             'css_class'=>'hidden',
                //             'dismiss_label' => true,
                //             'session' => true
                //         ),
                //     )
                // ),
                'use_discount',
                array(
                    'name' => 'session_sponsor',
                    'css_class' => 'choose_sponsor_amount',
                    'label' =>'LBL_ORDER_SPONSOR',
                    'type' => 'sponsor_code',
                    'fields' => array(
                        array(
                            'name' => 'order_sponsor_percent',
                            'type' => 'discount',
                            'convertToBase' => true,
                            'showTransactionalAmount' => true,
                            'percent' => 'true',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                        array(
                            'name' => 'order_sponsor_amount',
                            'type' => 'currency',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                        array(
                            'name' => 'sponsor_detail',
                            'css_class'=>'hidden',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                    )
                ),
                array(
                    'name' => 'session_loyalty',
                    'css_class' => 'choose_loyalty_amount',
                    'label' =>'LBL_ORDER_LOYALTY',
                    'type' => 'discount_icon',
                    'fields' => array(
                        array(
                            'name' => 'order_loyalty_percent',
                            'type' => 'discount',
                            'convertToBase' => true,
                            'showTransactionalAmount' => true,
                            'percent' => 'true',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                        array(
                            'name' => 'order_loyalty_amount',
                            'type' => 'currency',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                        array(
                            'name' => 'loyalty_detail',
                            'css_class'=>'hidden',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                    )
                ),
                array(
                    'name' => 'use_free_balance',
                    'type' => 'currency',
                ),
                array(
                    'name' => 'total',
                    'label' => 'LBL_LIST_GRAND_TOTAL',
                    'type' => 'currency',
                    'css_class' => 'grand-total',
                ),
                array(
                    'name' => 'paid_amount',
                    'label' => 'LBL_PAID_AMOUNT',
                    'css_class' =>'layer_highlight_paid'
                ),
                array(
                    'name' => 'unpaid_amount',
                    'label' => 'LBL_UNPAID_AMOUNT',
                    'css_class' =>'layer_highlight_unpaid'
                ),
            ),
        ),
    ),
);
