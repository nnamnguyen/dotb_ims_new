<?php

$viewdefs['ProspectLists']['base']['view']['subpanel-list'] = array(
  'panels' => 
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array(
        array(
          'label' => 'LBL_LIST_PROSPECT_LIST_NAME',
          'enabled' => true,
          'default' => true,
          'name' => 'name',
          'link' => true,
        ),
        array(
          'label' => 'LBL_LIST_DESCRIPTION',
          'enabled' => true,
          'default' => true,
          'name' => 'description',
        ),
        array(
          'label' => 'LBL_LIST_TYPE_NO',
          'enabled' => true,
          'default' => true,
          'name' => 'list_type',
        ),
        array(
          'label' => 'LBL_LIST_ENTRIES',
          'enabled' => true,
          'default' => true,
          'name' => 'entry_count',
        ),
      ),
    ),
  ),
);
