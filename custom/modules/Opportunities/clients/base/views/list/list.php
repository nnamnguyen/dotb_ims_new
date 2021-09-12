<?php
$viewdefs['Opportunities'] = 
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
                'label' => 'LBL_LIST_OPPORTUNITY_NAME',
                'enabled' => true,
                'default' => true,
                'related_fields' => 
                array (
                  0 => 'total_revenue_line_items',
                  1 => 'closed_revenue_line_items',
                  2 => 'included_revenue_line_items',
                ),
                'link' => true,
              ),
              1 => 
              array (
                'name' => 'account_name',
                'label' => 'LBL_LIST_ACCOUNT_NAME',
                'enabled' => true,
                'default' => true,
                'id' => 'ACCOUNT_ID',
                'link' => true,
                'sortable' => true,
              ),
              2 => 
              array (
                'name' => 'date_closed',
                'label' => 'LBL_DATE_CLOSED',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'sales_stage',
                'label' => 'LBL_SALES_STAGE',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'opportunity_type',
                'label' => 'LBL_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'amount',
                'label' => 'LBL_LIKELY',
                'enabled' => true,
                'default' => true,
                'related_fields' => 
                array (
                  0 => 'amount',
                  1 => 'currency_id',
                  2 => 'base_rate',
                ),
                'currency_format' => true,
                'type' => 'currency',
                'currency_field' => 'currency_id',
                'base_rate_field' => 'base_rate',
              ),
              6 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_LIST_ASSIGNED_USER',
                'enabled' => true,
                'default' => true,
                'id' => 'ASSIGNED_USER_ID',
                'link' => true,
                'sortable' => true,
              ),
              7 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'readonly' => true,
              ),
              8 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'default' => false,
                'sortable' => false,
              ),
              9 => 
              array (
                'name' => 'tag',
                'label' => 'LBL_TAGS',
                'enabled' => true,
                'default' => false,
              ),
              10 => 
              array (
                'name' => 'modified_by_name',
                'label' => 'LBL_MODIFIED',
                'enabled' => true,
                'default' => false,
                'id' => 'MODIFIED_USER_ID',
                'link' => true,
                'readonly' => true,
                'sortable' => true,
              ),
              11 => 
              array (
                'name' => 'lead_source',
                'label' => 'LBL_LEAD_SOURCE',
                'enabled' => true,
                'default' => false,
              ),
              12 => 
              array (
                'name' => 'campaign_name',
                'label' => 'LBL_CAMPAIGN',
                'enabled' => true,
                'default' => false,
                'id' => 'CAMPAIGN_ID',
                'link' => true,
                'sortable' => false,
              ),
              13 => 
              array (
                'name' => 'next_step',
                'label' => 'LBL_NEXT_STEP',
                'enabled' => true,
                'default' => false,
              ),
              14 => 
              array (
                'name' => 'best_case',
                'label' => 'LBL_BEST',
                'enabled' => true,
                'default' => false,
                'related_fields' => 
                array (
                  0 => 'currency_id',
                  1 => 'base_rate',
                ),
                'currency_format' => true,
              ),
              15 => 
              array (
                'name' => 'worst_case',
                'label' => 'LBL_WORST',
                'enabled' => true,
                'default' => false,
                'related_fields' => 
                array (
                  0 => 'currency_id',
                  1 => 'base_rate',
                ),
                'currency_format' => true,
              ),
              16 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_LIST_TEAM',
                'enabled' => true,
                'default' => false,
                'type' => 'teamset',
              ),
              17 => 
              array (
                'name' => 'date_modified',
                'label' => 'LBL_DATE_MODIFIED',
                'enabled' => true,
                'default' => false,
                'readonly' => true,
              ),
              18 => 
              array (
                'name' => 'probability',
                'label' => 'LBL_PROBABILITY',
                'enabled' => true,
                'default' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
