<?php
$viewdefs['Prospects'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'list' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'name',
                'type' => 'fullname',
                'fields' => 
                array (
                  0 => 'salutation',
                  1 => 'first_name',
                  2 => 'last_name',
                ),
                'link' => true,
                'css_class' => 'full-name',
                'label' => 'LBL_LIST_NAME',
                'enabled' => true,
                'default' => true,
              ),
              1 => 
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'type' => 'event-status',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'title',
                'label' => 'LBL_LIST_TITLE',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'email',
                'label' => 'LBL_LIST_EMAIL_ADDRESS',
                'sortable' => false,
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'phone_work',
                'label' => 'LBL_LIST_PHONE',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'readonly' => true,
              ),
            ),
          ),
        ),
          'orderBy' =>
              array (
                  'field' => 'date_entered',
                  'direction' => 'desc',
              ),
      ),
    ),
  ),
);
