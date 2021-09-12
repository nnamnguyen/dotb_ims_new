<?php
$viewdefs['Accounts'] = 
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
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'name',
                'link' => true,
                'label' => 'LBL_LIST_ACCOUNT_NAME',
                'enabled' => true,
                'default' => true,
                'width' => 'xlarge',
              ),
              1 => 
              array (
                'name' => 'phone_office',
                'label' => 'LBL_LIST_PHONE',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'email',
                'label' => 'LBL_EMAIL_ADDRESS',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'website',
                'label' => 'LBL_WEBSITE',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_LIST_ASSIGNED_USER',
                'id' => 'ASSIGNED_USER_ID',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'billing_address_street',
                'label' => 'LBL_BILLING_ADDRESS_STREET',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'date_entered',
                'type' => 'datetime',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'readonly' => true,
              ),
              7 => 
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => false,
              ),
              8 => 
              array (
                'name' => 'industry',
                'label' => 'LBL_INDUSTRY',
                'enabled' => true,
                'default' => false,
              ),
              9 => 
              array (
                'name' => 'business_code',
                'label' => 'LBL_BUSINESS_CODE',
                'enabled' => true,
                'default' => false,
              ),
              10 => 
              array (
                'name' => 'date_of_issue',
                'label' => 'LBL_DATE_OF_ISSUE',
                'enabled' => true,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'modified_by_name',
                'label' => 'LBL_MODIFIED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'MODIFIED_USER_ID',
                'link' => true,
                'default' => false,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
