<?php

$viewdefs['J_Discount']['base']['view']['selection-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                1 =>
                    array (
                        'name' => 'name',
                        'label' => 'LBL_NAME',
                        'default' => true,
                        'enabled' => true,
                        'link' => true,
                        'width' => 'xlarge',
                    ),
                2 =>
                    array (
                        'name' => 'status',
                        'label' => 'LBL_STATUS',
                        'enabled' => true,
                        'default' => true,
                        'type' => 'html',
                    ),
                3 =>
                    array (
                        'name' => 'type',
                        'label' => 'LBL_TYPE',
                        'enabled' => true,
                        'default' => true,
                    ),
//                4 =>
//                    array (
//                        'name' => 'category',
//                        'label' => 'LBL_CATEGORY',
//                        'enabled' => true,
//                        'default' => true,
//                    ),
                5 =>
                    array (
                        'name' => 'discount_percent',
                        'label' => 'LBL_DISCOUNT_PERCENT',
                        'enabled' => true,
                        'default' => true,
                    ),
                6 =>
                    array (
                        'name' => 'discount_amount',
                        'label' => 'LBL_DISCOUNT_AMOUNT',
                        'enabled' => true,
                        'default' => true,
                    ),
                array(
                    'name' => 'description',
                    'width' => 'xlarge',),
                array(
                    'name' => 'product_discount',
                    'enabled' => true,),
//                7 =>
//                    array (
//                        'name' => 'policy',
//                        'label' => 'LBL_POLICY',
//                        'enabled' => true,
//                        'sortable' => false,
//                        'default' => true,
//                    ),
//                8 =>
//                    array (
//                        'name' => 'team_name',
//                        'label' => 'LBL_TEAM',
//                        'default' => true,
//                        'enabled' => true,
//                    ),
//                9 =>
//                    array (
//                        'name' => 'date_modified',
//                        'enabled' => true,
//                        'default' => true,
//                    ),
//                10 =>
//                    array (
//                        'name' => 'date_entered',
//                        'enabled' => true,
//                        'default' => false,
//                    ),
//                11 =>
//                    array (
//                        'name' => 'assigned_user_name',
//                        'label' => 'LBL_ASSIGNED_TO_NAME',
//                        'default' => false,
//                        'enabled' => true,
//                        'link' => true,
//                    ),
            ),
        ),
    ),
);
