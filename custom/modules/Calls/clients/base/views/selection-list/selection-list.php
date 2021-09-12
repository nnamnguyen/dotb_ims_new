<?php
$viewdefs['Calls'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'selection-list' => 
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
                'label' => 'LBL_LIST_SUBJECT',
                'enabled' => true,
                'default' => true,
                'link' => true,
                'name' => 'name',
                'width' => 'small',
              ),
              1 => 
              array (
                'name' => 'parent_name',
                'label' => 'LBL_LIST_RELATED_TO',
                'dynamic_module' => 'PARENT_TYPE',
                'id' => 'PARENT_ID',
                'link' => true,
                'enabled' => true,
                'default' => true,
                'sortable' => false,
                'ACLTag' => 'PARENT',
                'related_fields' => 
                array (
                  0 => 'parent_id',
                  1 => 'parent_type',
                ),
              ),
              2 => 
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
                'width' => 'large',
              ),
              3 => 
              array (
                'name' => 'recall_at',
                'label' => 'LBL_RECALL_AT',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'label' => 'LBL_LIST_DATE',
                'enabled' => true,
                'default' => true,
                'name' => 'date_start',
              ),
              5 => 
              array (
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => true,
                'name' => 'status',
                'type' => 'event-status',
                'css_class' => 'full-width',
              ),
              6 => 
              array (
                'name' => 'call_result',
                'label' => 'LBL_CALL_RESULT',
                'enabled' => true,
                'default' => true,
              ),
              7 => 
              array (
                'name' => 'assigned_user_name',
                'target_record_key' => 'assigned_user_id',
                'target_module' => 'Employees',
                'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
                'enabled' => true,
                'default' => true,
                'sortable' => false,
              ),
              8 => 
              array (
                'label' => 'LBL_DATE_END',
                'enabled' => true,
                'default' => false,
                'name' => 'date_end',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
