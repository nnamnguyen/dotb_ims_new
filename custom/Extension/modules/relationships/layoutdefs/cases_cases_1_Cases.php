<?php
 // created: 2020-04-15 03:31:01
$layout_defs["Cases"]["subpanel_setup"]['cases_cases_1'] = array (
  'order' => 100,
  'module' => 'Cases',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CASES_CASES_1_FROM_CASES_R_TITLE',
  'get_subpanel_data' => 'cases_cases_1',
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
