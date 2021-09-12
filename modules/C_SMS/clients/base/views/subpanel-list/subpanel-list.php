<?php

$module_name = 'C_SMS';
$viewdefs[$module_name]['base']['view']['subpanel-list'] = array(
    'panels' =>
        array(
            array(
                'name' => 'panel_header',
                'label' => 'LBL_PANEL_1',
                'fields' =>
                    array(
                        array(
                            'label' => 'LBL_NAME',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'name',
                            'link' => true,
                        ),
                        array(
                            'label' => 'LBL_DATE_SEND',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'date_send',
                        ),
                        array(
                            'label' => 'LBL_DELIVERY_STATUS',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'delivery_status',
                        ),
                        array(
                            'label' => 'LBL_LIST_RELATED_TO',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'parent_name',
                        ),
                        array(
                            'label' => 'LBL_SUPPLIER',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'supplier',
                        ),
                        array(
                            'label' => 'LBL_DESCRIPTION',
                            'enabled' => true,
                            'default' => true,
                            'name' => 'description',
                        ),
                    ),
            ),
        ),
    'rowactions' =>
        array (
            'actions' =>
                array (
                    0 =>
                        array (
                            'type' => 'rowaction',
                            'css_class' => 'btn',
                            'tooltip' => 'LBL_PREVIEW',
                            'event' => 'list:preview:fire',
                            'icon' => 'fa-search-plus',
                            'acl_action' => 'view',
                        ),
                ),
        ),
    'orderBy' => array(
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
