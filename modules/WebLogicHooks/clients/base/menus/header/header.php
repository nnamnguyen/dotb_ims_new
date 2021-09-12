<?php

$module_name = 'WebLogicHooks';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#'.$module_name.'/create',
        'label' => 'LNK_NEW_LOGIC_HOOK',
        'acl_action' => 'create',
        'acl_module' => $module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#'.$module_name,
        'label' => 'LNK_LOGIC_HOOK_LIST',
        'acl_action' => 'list',
        'acl_module' => $module_name,
        'icon' => 'fa-bars',
    ),
);
