<?php

$viewdefs['Documents']['base']['view']['subpanel-for-contracttype'] = array(
  'type' => 'subpanel-list',
  'panels' =>
  array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' =>
      array(
        array(
          'name' => 'document_name',
          'label' => 'LBL_LIST_DOCUMENT_NAME',
          'enabled' => true,
          'default' => true,
          'link' => true,
        ),
        array(
          'name' => 'is_template',
          'label' => 'LBL_LIST_IS_TEMPLATE',
          'enabled' => true,
          'default' => true,
        ),
        array(
          'name' => 'template_type',
          'label' => 'LBL_LIST_TEMPLATE_TYPE',
          'enabled' => true,
          'default' => true,
        ),
        array(
          'name' => 'latest_revision',
          'label' => 'LBL_LATEST_REVISION',
          'enabled' => true,
          'default' => true,
        ),
      ),
    ),
  ),
);
