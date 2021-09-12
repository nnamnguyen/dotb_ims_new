<?php
// created: 2020-10-21 14:49:00
$viewdefs['J_Sponsor']['base']['view']['subpanel-for-quotes-quotes_sponsor'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
          0 =>
              array (
                  'name' => 'name',
                  'label' => 'LBL_NAME',
                  'default' => true,
                  'enabled' => true,
                  'link' => true,
              ),
          1 =>
              array (
                  'name' => 'amount',
                  'label' => 'LBL_AMOUNT',
                  'enabled' => true,
                  'currency_format' => true,
                  'default' => true,
              ),
          2 =>
              array (
                  'name' => 'percent',
                  'label' => 'LBL_PERCENT',
                  'enabled' => true,
                  'default' => true,
              ),
          3 =>
              array (
                  'name' => 'total_down',
                  'enabled' => true,
                  'default' => true,
              ),
          4 =>
              array (
                  'name' => 'type',
                  'label' => 'LBL_TYPE',
                  'enabled' => true,
                  'default' => true,
              ),
          5 =>
              array (
                  'name' => 'foc_type',
                  'label' => 'LBL_FOC_TYPE',
                  'enabled' => true,
                  'default' => true,
              ),
          8 =>
              array (
                  'name' => 'description',
                  'label' => 'LBL_DESCRIPTION',
                  'enabled' => true,
                  'sortable' => false,
                  'default' => false,
              ),
      ),
    ),
  ),
  'orderBy' => 
  array (
    'field' => 'date_modified',
    'direction' => 'desc',
  ),
  'type' => 'subpanel-list',
);