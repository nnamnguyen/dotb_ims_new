<?php

$module_name = 'Quotes';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#Quotes/create',
        'label' =>'LNK_NEW_QUOTE',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_QUOTE_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route' => '#Reports?filterModule=' . $module_name,
        'label' =>'LNK_QUOTE_REPORTS',
        'acl_action'=>'list',
        'acl_module' => 'Reports',
        'icon' => 'fa-user-chart',
    ),
    array(
        'route'=>'#C_AdminConfig/layout/order_setting',
        'label' =>'LBL_QUOTE_SETTING',
        'acl_action'=>'admin',
        'acl_module'=>'Administration',
        'icon' => 'fa-money-check-edit-alt',
    ),
);
