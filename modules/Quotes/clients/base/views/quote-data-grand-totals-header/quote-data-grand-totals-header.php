<?php

$viewdefs['Quotes']['base']['view']['quote-data-grand-totals-header'] = array(
    'buttons' => array(
        array(
            'type' => 'quote-data-actiondropdown',
            'name' => 'panel_dropdown',
            'no_default_action' => true,
            'buttons' => array(
                array(
                    'type' => 'button',
                    'icon' => 'fa-plus',
                    'name' => 'create_qli_button',
                    'label' => 'LBL_CREATE_QLI_BUTTON_LABEL',
                    'acl_action' => 'create',
                    'tooltip' => 'LBL_CREATE_QLI_BUTTON_TOOLTIP',
                ),
                array(
                    'type' => 'button',
                    'icon' => 'fa-plus',
                    'name' => 'create_comment_button',
                    'label' => 'LBL_CREATE_COMMENT_BUTTON_LABEL',
                    'acl_action' => 'create',
                    'tooltip' => 'LBL_CREATE_COMMENT_BUTTON_TOOLTIP',
                ),
                array(
                    'type' => 'button',
                    'icon' => 'fa-plus',
                    'name' => 'create_group_button',
                    'label' => 'LBL_CREATE_GROUP_BUTTON_LABEL',
                    'acl_action' => 'create',
                    'tooltip' => 'LBL_CREATE_GROUP_BUTTON_TOOLTIP',
                ),
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_quote_data_grand_totals_header',
            'label' => 'LBL_QUOTE_DATA_GRAND_TOTALS_HEADER',
            'fields' => array(
                array(
                    'name' => 'new_sub',
                    'css_class' => 'quote-totals-row-item',
                ),
                array(
                    'name' => 'deal_tot',
                    'label' => 'LBL_LIST_DEAL_TOT',
                    'css_class' => 'quote-totals-row-item',
                    'related_fields' => array('deal_tot_discount_percentage'),
                ),
//                array(
//                    'name' => 'tax',
//                    'label' => 'LBL_TAX_TOTAL',
//                    'css_class' => 'quote-totals-row-item',
//                ),
//                array(
//                    'name' => 'shipping',
//                    'css_class' => 'quote-totals-row-item',
//                ),
                array(
                    'name' => 'use_free_balance',
                    'type' => 'currency',
                    'css_class' => 'quote-totals-row-item',
                ),
                array(
                    'name' => 'total',
                    'label' => 'LBL_LIST_GRAND_TOTAL',
                    'css_class' => 'quote-totals-row-item',
                ),
            ),
        ),
    ),
);
