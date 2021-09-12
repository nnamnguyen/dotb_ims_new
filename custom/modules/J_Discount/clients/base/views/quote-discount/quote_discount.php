<?php
$module_name = 'J_Discount';
$viewdefs[$module_name] =
    array (
        'base' =>
            array (
                'view' =>
                    array (
                        'quote-discount' =>
                            array (
                                'fields' => array(
                                    array(
                                        'type' => 'fieldset',
                                        'show_child_labels'=> true,
                                        'fields' => array(
                                            array(
                                            'name' => 'order_total_amount',
                                            'label' => 'LBL_ORDER_TOTAL_AMOUNT',
                                            'type' => 'currency')
                                        )
                                    ),
                                    array(
                                        'type' => 'fieldset',
                                        'show_child_labels'=> true,
                                        'fields' => array(
                                            array(
                                            'name' => 'total_discount_amount',
                                            'label' => 'LBL_TOTAL_DISCOUNT_AMOUNT',
                                            'type' => 'currency')
                                        )
                                    ),
                                    array(
                                        'type' => 'fieldset',
                                        'show_child_labels'=> true,
                                        'fields' => array(
                                            array(
                                            'name' => 'total_discount_percent',
                                            'label' => 'LBL_TOTAL_DISCOUNT_PERCENT',
                                            'type' => 'currency')
                                        )
                                    ),
                                    array(
                                        'type' => 'fieldset',
                                        'show_child_labels'=> true,
                                        'fields' => array(
                                            array(
                                            'name' => 'total_discount',
                                            'label' => 'LBL_TOTAL_DISCOUNT',
                                            'type' => 'currency')
                                        )
                                    ),
                                    array(
                                        'type' => 'fieldset',
                                        'show_child_labels'=> true,
                                        'fields' => array(
                                            array(
                                            'name' => 'final_discount',
                                            'label' => 'LBL_FINAL_DISCOUNT',
                                            'type' => 'currency'
                                            )
                                        )
                                    ),
                                ),
                                'templateMeta' =>
                                    array (
                                        'useTabs' => false,
                                    ),
                            ),
                    ),
            ),
    );
