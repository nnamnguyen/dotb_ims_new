<?php

$viewdefs['Products']['base']['view']['quote-data-group-list'] = array(
    'panels' => array(
        array(
            'name' => 'products_quote_data_group_list',
            'label' => 'LBL_PRODUCTS_QUOTE_DATA_LIST',
            'fields' => array(
                array(
                    'name' => 'line_num',
                    'label' => null,
                    'widthClass' => 'cell-xsmall',
                    'css_class' => 'line_num tcenter',
                    'type' => 'line-num',
                    'readonly' => true,
                ),
                array(
                    'name' => 'product_detail',
                    'label' => 'LBL_PRODUC_TDETAIL',
                    'type' => 'fieldset',
                    'widthClass' => 'cell-large',
                    'css_class' => 'hidden_nodata',
                    'fields' => array(
                        array(
                            'name' => 'product_template_name',
                            'label' => 'LBL_ITEM_NAME',
                            'type' => 'quote-data-relate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'description',
                            'label' => 'LBL_ITEM_NAME',
                            'widthClass' => 'cell-large',
                            'css_style' =>'font-style:italic;color:grey',
                            'only_detail' => true,
                            'readonly' => true,
                        ),
                    )

                ),
                array(
                    'name' => 'list_price',
                    'label' => 'LBL_LIST_PRICE',
                    'type' => 'currency',
                    'convertToBase' => true,
                    'showTransactionalAmount' => true,
                    'related_fields' => array(
                        'list_price',
                        'currency_id',
                        'base_rate',
                    ),
                    'widthClass' => 'cell-small',
                ),
                array(
                    'name' => 'quantity',
                    'label' => 'LBL_QUANTITY',
                    'widthClass' => 'cell-small',
                    'css_class' => 'quantity',
                    'type' => 'float',
                ),
                array(
                    'name' => 'unit_name',
                    'label' => 'LBL_UNIT',
                    'type' => 'relate',
                    'related_fields' => array(
                        'unit_id',
                        'unit_name'
                    ),
                    'required' => true,
                    'widthClass' => 'cell-small',
                ),
                array(
                    'name' => 'subtotal',
                    'label' => 'LBL_SUBTOTAL',
                    'type' => 'currency',
                    'widthClass' => 'cell-medium',
                    'showTransactionalAmount' => true,
                    'related_fields' => array(
                        'currency_id',
                        'base_rate',
                        'list_price',
                        'quantity'
                    ),
                ),
                array(
                    'widthClass' => 'cell-medium',
                    'name' => 'session_discount',
                    'css_class' => 'product_discount',
                    'label' =>'LBL_ORDER_DISCOUNT',
                    'type' => 'discount_icon',
                    'dismiss_label' => true,
                    'fields' => array(
                        array(
                            'name' => 'discount_percent',
                            'type' => 'discount',
                            'convertToBase' => true,
                            'showTransactionalAmount' => true,
                            'percent' => 'true',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                        array(
                            'name' => 'discount_amount',
                            'type' => 'currency',
                            'dismiss_label' => true,
                            'session' => true
                        ),
                        'discount_detail'
                    )
                ),
//                array(
//                    'name' => 'discount',
//                    'type' => 'fieldset',
//                    'css_class' => 'quote-discount-percent',
//                    'label' => 'LBL_DISCOUNT_AMOUNT',
//                    'fields' => array(
//                        array(
//                            'name' => 'discount_amount',
//                            'label' => 'LBL_DISCOUNT_AMOUNT',
//                            'type' => 'discount',
//                            'convertToBase' => true,
//                            'showTransactionalAmount' => true,
//                        ),
//                        array(
//                            'type' => 'discount-select',
//                            'name' => 'discount_select',
//                            'no_default_action' => true,
//                            'buttons' => array(
//                                array(
//                                    'type' => 'rowaction',
//                                    'name' => 'select_discount_amount_button',
//                                    'label' => 'LBL_DISCOUNT_AMOUNT',
//                                    'event' => 'button:discount_select_change:click',
//                                ),
//                                array(
//                                    'type' => 'rowaction',
//                                    'name' => 'select_discount_percent_button',
//                                    'label' => 'LBL_DISCOUNT_PERCENT',
//                                    'event' => 'button:discount_select_change:click',
//                                ),
//                            ),
//                        ),
//                    ),
//                ),
                array(
                    'name' => 'total_amount',
                    'label' => 'LBL_LINE_ITEM_TOTAL',
                    'type' => 'currency',
                    'widthClass' => 'cell-medium',
                    'showTransactionalAmount' => true,
                    'related_fields' => array(
                        'total_amount',
                        'currency_id',
                        'base_rate',
                    ),
                ),
                array(
                    'name' => 'product_discount',
                    'label' => 'LBL_DISCOUNT_FOR_PRODUCT',
                    'widthClass' => 'cell-medium',
                    'css_class' => 'hidden',
                    'css_style' => 'display:none'
                ),
            ),
        ),
    ),
);
