<?php
$viewdefs['Cases'] = 
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
                'name' => 'case_number',
                'label' => 'LBL_LIST_NUMBER',
                'default' => true,
                'enabled' => true,
                'readonly' => true,
                'width' => 'xsmall',
              ),
              1 => 
              array (
                'name' => 'name',
                'label' => 'LBL_LIST_SUBJECT',
                'link' => true,
                'default' => true,
                'enabled' => true,
                'width' => 'xlarge',
              ),
              2 => 
              array (
                'name' => 'rate',
                'label' => 'LBL_RATE',
                'enabled' => true,
                'readonly' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'parent_name',
                'label' => 'LBL_LIST_RELATED_TO',
                'enabled' => true,
                'id' => 'ACCOUNT_ID',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'default' => true,
                'enabled' => true,
              ),
              5 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'default' => true,
                'enabled' => true,
                'readonly' => true,
              ),
              6 => 
              array (
                'name' => 'last_comment',
                'enabled' => true,
                'default' => true,
                  'type'=>'html',
              ),
              7 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'id' => 'ASSIGNED_USER_ID',
                'default' => false,
                'enabled' => true,
              ),
              8 => 
              array (
                'name' => 'account_name',
                'label' => 'LBL_LIST_ACCOUNT_NAME',
                'module' => 'Accounts',
                'id' => 'ACCOUNT_ID',
                'ACLTag' => 'ACCOUNT',
                'related_fields' => 
                array (
                  0 => 'account_id',
                ),
                'link' => true,
                'default' => false,
                'enabled' => true,
              ),
              9 => 
              array (
                'name' => 'priority',
                'label' => 'LBL_LIST_PRIORITY',
                'default' => false,
                'enabled' => true,
              ),
              10 => 
              array (
                'name' => 'tag',
                'label' => 'LBL_TAGS',
                'enabled' => true,
                'default' => false,
              ),
              11 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'source',
                'label' => 'LBL_SOURCE',
                'enabled' => true,
                'default' => false,
              ),
              13 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_LIST_TEAM',
                'default' => false,
                'enabled' => true,
              ),
              14 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
