<?php
$layout_defs["Quotes"]["subpanel_setup"]["quote_paymentdetails"] = array (
    'order' => 70,
    'module' => 'J_PaymentDetail',
    'subpanel_name' => 'default',
    'title_key' => 'LBL_PAYMENT_DETAIL',
    'sort_order' => 'asc',
    'sort_by' => 'payment_no',
    'get_subpanel_data' => 'quote_paymentdetails',
    'top_buttons' =>
        array (
            0 =>
                array (
                    'widget_class' => 'SubPanelTopButtonQuickCreate',
                ),
            1 =>
                array (
                    'widget_class' => 'SubPanelTopSelectButton',
                    'mode' => 'MultiSelect',
                ),
        ),
);
