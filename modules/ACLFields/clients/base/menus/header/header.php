<?php

$module_name = 'ACLRoles';
global $mod_string;
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name,
        'label' =>'LIST_ROLES',
        'acl_module'=>$module_name,
        'acl_action'=>'list',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=ACLRoles&action=ListUsers',
        'label' =>'LIST_ROLES_BY_USER',
        'acl_module'=>$module_name,
        'acl_action'=>'list',
        'icon' => 'fa-bars',
    ),
);
