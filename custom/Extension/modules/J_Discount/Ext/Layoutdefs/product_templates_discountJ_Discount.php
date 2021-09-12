<?php
// created: 2020-10-16 11:17:57
$layout_defs["J_Discount"]["subpanel_setup"]['product_templates_discount'] = array (
    'order' => 100,
    'module' => 'ProductTemplates',
    'subpanel_name' => 'default',
    'sort_order' => 'asc',
    'sort_by' => 'id',
    'title_key' => 'LBL_J_DISCOUNT_PRODUCT_TEMPLATES',
    'get_subpanel_data' => 'product_templates_discount',
    'top_buttons' =>
        array (
//            0 =>
//                array (
//                    'widget_class' => 'SubPanelTopButtonQuickCreate',
//                ),
            1 =>
                array (
                    'widget_class' => 'SubPanelTopSelectButton',
                    'mode' => 'MultiSelect',
                ),
        ),
);
