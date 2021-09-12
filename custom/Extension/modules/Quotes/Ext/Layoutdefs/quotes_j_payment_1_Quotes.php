<?php
 // created: 2020-10-23 10:43:54
$layout_defs["Quotes"]["subpanel_setup"]['quotes_j_payment_1'] = array (
  'order' => 100,
  'module' => 'J_Payment',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_QUOTES_J_PAYMENT_1_FROM_J_PAYMENT_TITLE',
  'get_subpanel_data' => 'quotes_j_payment_1',
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
