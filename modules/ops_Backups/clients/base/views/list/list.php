<?php
$module_name = 'ops_Backups';
$viewdefs[$module_name]['base']['view']['list'] = array(
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_1',
            'fields' => array (
                array (
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                    'width' => '10%',
                ),
                array (
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'readonly' => true,
                    'type' => 'datetime',
                    'width' => '10%',
                    'default' => true,
                ),
                array (
                    'name' => 'expires_at',
                    'label' => 'LBL_EXPIRES_AT',
                    'enabled' => true,
                    'readonly' => true,
                    'type' => 'datetime',
                    'width' => '10%',
                    'default' => true,
                ),
                array (
                    'name' => 'download_link',
                    'label' => 'LBL_DOWNLOAD_URL',
                    'readonly' => true,
                    'enabled' => true,
                    'width' => '10%',
                    'default' => true,
                ),
            ),
        ),
    ),
    'orderBy' => array (
        'field' => 'expires_at',
        'direction' => 'desc',
    ),
);
