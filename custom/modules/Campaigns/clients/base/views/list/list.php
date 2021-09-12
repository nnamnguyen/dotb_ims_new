<?php
$viewdefs['Campaigns'] = 
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
                'label' => 'LBL_LIST_NAME',
                'enabled' => true,
                'default' => true,
                'width' => '20',
              ),
              1 => 
              array (
                'name' => 'status',
                'label' => 'LBL_LIST_STATUS',
                'enabled' => true,
                'default' => true,
                'width' => '10',
              ),
              2 => 
              array (
                'name' => 'campaign_type',
                'label' => 'LBL_LIST_TYPE',
                'enabled' => true,
                'default' => true,
                'width' => '10',
              ),
              3 => 
              array (
                'name' => 'assigned_user_name',
                'module' => 'Users',
                'label' => 'LBL_LIST_ASSIGNED_USER',
                'id' => 'ASSIGNED_USER_ID',
                'sortable' => false,
                'default' => true,
                'enabled' => true,
                'width' => '8',
              ),
              4 => 
              array (
                'name' => 'end_date',
                'label' => 'LBL_LIST_END_DATE',
                'default' => true,
                'enabled' => true,
                'width' => '10',
              ),
              5 => 
              array (
                'name' => 'date_entered',
                'type' => 'datetime',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'readonly' => true,
                'width' => '10',
              ),
              6 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => false,
                'enabled' => true,
                'width' => '15',
              ),
              7 => 
              array (
                'name' => 'objective',
                'label' => 'LBL_CAMPAIGN_OBJECTIVE',
                'enabled' => true,
                'sortable' => false,
                'default' => false,
                'width' => '10',
              ),
              8 => 
              array (
                'name' => 'budget',
                'label' => 'LBL_CAMPAIGN_BUDGET',
                'enabled' => true,
                'currency_format' => true,
                'default' => false,
                'width' => '10',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
