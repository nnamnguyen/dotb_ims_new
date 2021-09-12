<?php
$module_name = 'ops_Backups';
$viewdefs[$module_name] = 
array (
  'mobile' => 
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
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
                'width' => '10%',
              ),
              1 => 
              array (
                'name' => 'date_entered',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'readonly' => true,
                'width' => '10%',
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'expires_at',
                'label' => 'LBL_EXPIRES_AT',
                'enabled' => true,
                'readonly' => true,
                'width' => '10%',
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'redirect_url',
                'label' => 'LBL_DOWNLOAD_URL',
                'enabled' => true,
                'readonly' => true,
                'width' => '10%',
                'default' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
