<?php


$viewdefs['RevenueLineItems']['base']['view']['subpanel-for-accounts'] = array(
	'type' => 'subpanel-list',
	'favorite' => true,
	'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'link' => true,
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                        'name' => 'opportunity_name',
                        'sortable' => false,
                        'enabled' => true,
                        'default' => true
                ),
                array(
                    'name' => 'account_name',
                    'readonly' => true,
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'sales_stage',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'probability',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'date_closed',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'commit_stage',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'product_template_name',
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'category_name',
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'quantity',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'worst_case',
                    'type' => 'currency',
                    'related_fields' => array(
                        'currency_id',
                        'base_rate',
                        'total_amount',
                        'quantity',
                        'discount_amount',
                        'discount_price'
                    ),
                    'showTransactionalAmount' => true,
                    'convertToBase' => true,
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'likely_case',
                    'type' => 'currency',
                    'related_fields' => array(
                        'currency_id',
                        'base_rate',
                        'total_amount',
                        'quantity',
                        'discount_amount',
                        'discount_price'
                    ),
                    'showTransactionalAmount' => true,
                    'convertToBase' => true,
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'best_case',
                    'type' => 'currency',
                    'related_fields' => array(
                        'currency_id',
                        'base_rate',
                        'total_amount',
                        'quantity',
                        'discount_amount',
                        'discount_price'
                    ),
                    'showTransactionalAmount' => true,
                    'convertToBase' => true,
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'quote_name',
                    'label' => 'LBL_ASSOCIATED_QUOTE',
                    'related_fields' => array('quote_id'),
                    // this is a hack to get the quote_id field loaded
                    'readonly' => true,
                    'bwcLink' => true,
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'assigned_user_name',
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true
                )
            )
        )
    ),
    'selection' => array(),
    'rowactions' => array(
        'css_class' => 'pull-right',
        'actions' => array(
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
            ),
        ),
    ),
);
