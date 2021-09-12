<?php
$module_name = 'C_SMS';
$viewdefs[$module_name] = 
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
                'name' => 'delivery_status',
                'label' => 'LBL_DELIVERY_STATUS',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'parent_name',
                'label' => 'LBL_LIST_RELATED_TO',
                'enabled' => true,
                'id' => 'PARENT_ID',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'date_send',
                'label' => 'LBL_DATE_SEND',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'phone_number',
                'label' => 'LBL_PHONE_NUMBER',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'supplier',
                'label' => 'LBL_SUPPLIER',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
              ),
              7 => 
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => true,
              ),
              8 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
              9 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => false,
                'enabled' => true,
                'link' => true,
              ),
            ),
          ),
        ),
        'orderBy' => 
        array (
          'field' => 'date_modified',
          'direction' => 'desc',
        ),
      ),
    ),
  ),
);
