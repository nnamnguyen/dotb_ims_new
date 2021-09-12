<?php
$module_name = 'C_SiteDeployment';
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
                'label' => 'LBL_DOMAIN',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              1 =>
              array (
                'name' => 'site_url',
                'label' => 'LBL_SITE_URL',
                'enabled' => true,
                'default' => true,
                'width' => 'xsmall',
              ),
              2 =>
              array (
                'name' => 'quotes_c_sitedeployment_1_name',
                'label' => 'LBL_QUOTES_C_SITEDEPLOYMENT_1_FROM_QUOTES_TITLE',
                'enabled' => true,
                'id' => 'QUOTES_C_SITEDEPLOYMENT_1QUOTES_IDA',
                'link' => true,
                'sortable' => false,
                'default' => true,
              ),
              3 =>
              array (
                'name' => 'lic_type',
                'label' => 'LBL_LIC_TYPE',
                'enabled' => true,
                'default' => true,
              ),
              4 =>
              array (
                'name' => 'status',
                'label' => 'LBL_STATUS',
                'enabled' => true,
                'default' => true,
                  'type'=>'event-status'
              ),
              5 =>
              array (
                'name' => 'lic_remain',
                'label' => 'LBL_LIC_REMAIN',
                'enabled' => true,
                'default' => true,
                'type' => 'html',
              ),
              6 =>
              array (
                'name' => 'lic_users',
                'label' => 'LBL_LIC_USERS',
                'enabled' => true,
                'default' => true,
              ),
              7 =>
              array (
                'name' => 'lic_teams',
                'label' => 'LBL_LIC_TEAMS',
                'enabled' => true,
                'default' => true,
              ),
              8 =>
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => true,
              ),
              9 =>
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              10 =>
              array (
                'name' => 'date_expired',
                'label' => 'LBL_DATE_EXPIRED',
                'enabled' => true,
                'default' => false,
              ),
              11 =>
              array (
                'name' => 'pass_admin',
                'label' => 'LBL_PASS_ADMIN',
                'enabled' => true,
                'default' => false,
              ),
              12 =>
              array (
                'name' => 'user_admin',
                'label' => 'LBL_USER_ADMIN',
                'enabled' => true,
                'default' => false,
              ),
              13 =>
              array (
                'name' => 'git_url',
                'label' => 'LBL_GIT_URL',
                'enabled' => true,
                'default' => false,
              ),
              14 =>
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
              15 =>
              array (
                'name' => 'lic_storages',
                'label' => 'LBL_LIC_STORAGES',
                'enabled' => true,
                'default' => false,
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
