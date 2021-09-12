<?php
 // created: 2020-11-03 17:19:57
$layout_defs["Quotes"]["subpanel_setup"]['j_discount_quotes_1'] = array (
  'order' => 100,
  'module' => 'J_Discount',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_J_DISCOUNT_QUOTES_1_FROM_J_DISCOUNT_TITLE',
  'get_subpanel_data' => 'j_discount_quotes_1',
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
