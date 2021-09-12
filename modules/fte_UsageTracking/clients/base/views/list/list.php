<?php
$module_name = 'fte_UsageTracking';
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
                'name' => 'action',
                'label' => 'LBL_FTE_UT_ACTION',
                'enabled' => true,
                'default' => true,
              ),
                2 =>
                    array (
                        'name' => 'platform',
                        'label' => 'LBL_FTE_UT_PLATFORM',
                        'enabled' => true,
                        'default' => true,
                    ),
              3 =>  array(
                    'name' => 'related_record',
                    'type' => 'fte_related_fieldset',
                    'label' => 'LBL_RELATED_TO',
                    'fields' => array(
                        array (
                            'name' => 'parent_name',
                            'label' => 'LBL_RELATED_TO',
                            'enabled' => true,
                            'id' => 'PARENT_ID',
                            'link' => true,
                            'sortable' => false,
                            'default' => true,
                        ),
                        array(
                            'name' => 'related_module_name',
                        ),
                    ),
                ),
              4 =>
              array (
                'name' => 'created_by_name',
                'label' => 'LBL_CREATED',
                'enabled' => true,
                'readonly' => true,
                'id' => 'CREATED_BY',
                'link' => true,
                'default' => true,
              ),
              5 =>
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => true,
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
