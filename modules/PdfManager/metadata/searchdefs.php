<?php



$searchdefs['PdfManager'] =
array (
  'layout' =>
  array (
    'basic_search' =>
    array (
      'name' =>
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'base_module' =>
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_BASE_MODULE',
        'width' => '10%',
        'name' => 'base_module',
      ),
      'published' =>
      array (
        'name' => 'published',
        'default' => true,
        'width' => '10%',
      ),      
      'team_name' =>
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_TEAMS',
        'id' => 'TEAM_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'team_name',
      ),
    ),
    'advanced_search' =>
    array (),
  ),
  'templateMeta' =>
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' =>
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
