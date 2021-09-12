<?php


$module_name = 'Categories';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#'.$module_name.'/create',
        'label' => 'LNK_NEW_CATEGORY',
        'acl_action' => 'create',
        'acl_module' => $module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#'.$module_name,
        'label' => 'LNK_CATEGORY_LIST',
        'acl_action' => 'list',
        'acl_module' => $module_name,
        'icon' => 'fa-reorder',
    ),
);
