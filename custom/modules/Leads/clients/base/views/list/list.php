<?php
$viewdefs['Leads'] = 
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
                'type' => 'fullname',
                'fields' => 
                array (
                  0 => 'salutation',
                  1 => 'first_name',
                  2 => 'last_name',
                ),
                'link' => true,
                'label' => 'LBL_LIST_NAME',
                'enabled' => true,
                'default' => true,
              ),
              1 => 
              array (
                'name' => 'account_name',
                'label' => 'LBL_LIST_ACCOUNT_NAME',
                'enabled' => true,
                'default' => true,
                'related_fields' => 
                array (
                  0 => 'account_id',
                  1 => 'converted',
                ),
              ),
              2 => 
              array (
                'name' => 'status',
                'type' => 'event-status',
                'label' => 'LBL_LIST_STATUS',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'lead_source',
                'label' => 'LBL_LEAD_SOURCE',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'phone_mobile',
                'label' => 'LBL_MOBILE_PHONE',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'email',
                'label' => 'LBL_LIST_EMAIL_ADDRESS',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'address_city_2',
                'label' => 'LBL_ADDRESS_CITY_2',
                'enabled' => true,
                'default' => true,
              ),
              7 => 
              array (
                'name' => 'prefer_product',
                'label' => 'LBL_PREFER_PRODUCT',
                'enabled' => true,
                'default' => true,
              ),
              8 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_LIST_ASSIGNED_USER',
                'enabled' => true,
                'default' => true,
              ),
              9 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => true,
              ),
              10 => 
              array (
                'name' => 'phone_work',
                'label' => 'LBL_LIST_PHONE',
                'enabled' => true,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'last_name',
                'label' => 'LBL_LAST_NAME',
                'enabled' => true,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'facebook',
                'label' => 'LBL_FACEBOOK',
                'enabled' => true,
                'default' => false,
              ),
              13 => 
              array (
                'name' => 'salutation',
                'label' => 'LBL_SALUTATION',
                'enabled' => true,
                'default' => false,
              ),
              14 => 
              array (
                'name' => 'title',
                'label' => 'LBL_TITLE',
                'enabled' => true,
                'default' => false,
              ),
              15 => 
              array (
                'name' => 'lead_source_description',
                'label' => 'LBL_LEAD_SOURCE_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => false,
              ),
              16 => 
              array (
                'name' => 'first_name',
                'label' => 'LBL_FIRST_NAME',
                'enabled' => true,
                'default' => false,
              ),
              17 => 
              array (
                'name' => 'website',
                'label' => 'LBL_WEBSITE',
                'enabled' => true,
                'default' => false,
              ),
              18 => 
              array (
                'name' => 'utm_source',
                'label' => 'LBL_UTM_SOURCE',
                'enabled' => true,
                'default' => false,
              ),
              19 => 
              array (
                'name' => 'created_by_name',
                'label' => 'LBL_CREATED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'CREATED_BY',
                'link' => true,
                'default' => false,
              ),
              20 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => false,
                'readonly' => true,
              ),
              21 => 
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
          'field' => 'date_entered',
          'direction' => 'desc',
        ),
      ),
    ),
  ),
);
