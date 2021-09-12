<?php


$module_name = 'KBContentTemplates';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#'.$module_name.'/create',
        'label' => 'LNK_NEW_KBCONTENT_TEMPLATE',
        'acl_action' => 'create',
        'acl_module' => $module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#'.$module_name,
        'label' => 'LNK_LIST_KBCONTENT_TEMPLATES',
        'acl_action' => 'list',
        'acl_module' => $module_name,
        'icon' => 'fa-reorder',
    ),
);
