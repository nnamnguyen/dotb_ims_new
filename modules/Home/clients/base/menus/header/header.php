<?php

$module_name = 'Home';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#' . $module_name . '/create',
        'label' => 'LBL_CREATE_DASHBOARD_MENU',
        'acl_action' => 'edit',
        'acl_module' => $module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#activities',
        'label' => 'LBL_ACTIVITIES',
        'icon' => 'fa-clock-o',
    ),
    array(
        'type' => 'divider',
    ),
    array(
        'route' => '#Dashboards?moduleName=Home',
        'label' => 'LBL_MANAGE_DASHBOARDS',
        'acl_action' => 'read',
        'acl_module' => 'Dashboards',
        'icon' => 'fa-bars',
        'label_module' => 'Dashboards',
    ),
);
