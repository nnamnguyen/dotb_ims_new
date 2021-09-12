<?php


$module_name = 'EmbeddedFiles';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#'.$module_name.'/create',
        'label' => 'LNK_NEW_EMBEDDED_FILE',
        'acl_action' => 'create',
        'acl_module' => $module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#'.$module_name,
        'label' => 'LNK_LIST_EMBEDDED_FILE',
        'acl_action' => 'list',
        'acl_module' => $module_name,
        'icon' => 'fa-reorder',
    ),
);
