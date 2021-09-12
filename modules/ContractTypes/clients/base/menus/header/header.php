<?php

$module_name = 'ContractTypes';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#' . $module_name . '/create',
        'label' =>'LNK_NEW_CONTRACTTYPE',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#' . $module_name,
        'label' =>'LNK_CONTRACTTYPE_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
);
