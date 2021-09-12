<?php
$module_name = 'C_Comments';
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
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' =>
            array (
              0 =>
              array (
                'name' => 'cases_c_comments_1_name',
                'label' => 'LBL_CASES_C_COMMENTS_1_FROM_CASES_TITLE',
                'enabled' => true,
                'id' => 'CASES_C_COMMENTS_1CASES_IDA',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              1 =>
              array (
                'name' => 'description',
                'label' => 'LBL_DESCRIPTION',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
                'width' => 'xxlarge',
                'type' => 'html',
              ),
              2 =>
              array (
                'name' => 'uploadfile',
                'label' => 'LBL_FILE_UPLOAD',
                'enabled' => true,
                'width' => 'small',
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'direction',
                'label' => 'LBL_DIRECTION',
                'enabled' => true,
                'default' => false,
              ),
              4 =>
              array (
                'name' => 'created_by_name',
                'label' => 'LBL_LIST_LAST_REV_CREATOR',
                'default' => false,
                'sortable' => false,
                'enabled' => true,
              ),
              5 =>
              array (
                'name' => 'date_entered',
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
