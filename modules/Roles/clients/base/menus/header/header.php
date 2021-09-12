<?php

$module_name = 'Roles';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_ROLE',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_ROLES',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-bars',
    ),
);
