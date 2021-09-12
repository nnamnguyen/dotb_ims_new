<?php
 // created: 2020-04-23 00:04:45
$layout_defs["Contacts"]["subpanel_setup"]['contacts_b_invoices_1'] = array (
  'order' => 100,
  'module' => 'B_Invoices',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_B_INVOICES_1_FROM_B_INVOICES_TITLE',
  'get_subpanel_data' => 'contacts_b_invoices_1',
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
