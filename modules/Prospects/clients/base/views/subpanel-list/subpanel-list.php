<?php

$viewdefs['Prospects']['base']['view']['subpanel-list'] = array(
  'panels' => array(
    array(
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => array(
        array(
            'name' => 'name',
            'type' => 'fullname',
            'fields' => array(
                'salutation',
                'first_name',
                'last_name',
            ),
            'link' => true,
          'label' => 'LBL_LIST_NAME',
          'enabled' => true,
          'default' => true,
        ),
        array(
          'label' => 'LBL_LIST_TITLE',
          'enabled' => true,
          'default' => true,
          'name' => 'title',
        ),
        array(
          'label' => 'LBL_LIST_EMAIL_ADDRESS',
          'enabled' => true,
          'default' => true,
          'name' => 'email',
          'sortable' => false,
        ),
        array(
          'label' => 'LBL_LIST_PHONE',
          'enabled' => true,
          'default' => true,
          'name' => 'phone_work',
        ),
      ),
    ),
  ),
);
