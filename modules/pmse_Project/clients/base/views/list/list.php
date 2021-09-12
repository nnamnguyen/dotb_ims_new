<?php


$viewdefs['pmse_Project']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'prj_module',
                    'label' => 'LBL_PRJ_MODULE',
                    'default' => true,
                    'enabled' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'prj_status',
                    'type' => 'process-status',
                    'label' => 'LBL_PRJ_STATUS',
                    'link' => false,
                    'default' => true,
                    'enabled' => true,
                    'readonly' => true,
                    'css_class' => 'full-width',
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_ASSIGNED_TO_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_modified',
                    'readonly' => true,
                ),
                array(
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_entered',
                    'readonly' => true,
                ),
            ),
        ),
    ),
    'orderBy' => array(
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);