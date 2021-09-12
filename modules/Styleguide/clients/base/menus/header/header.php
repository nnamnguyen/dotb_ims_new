<?php

$module_name = 'Styleguide';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/docs/index',
        'label' =>'Core Elements',
        'acl_action'=>'list',
        'acl_module'=>'Accounts',
        'icon' => 'fa-book',
    ),
    array(
        'route'=>'#'.$module_name.'/fields/index',
        'label' =>'Example Dotb7 Fields',
        'acl_action'=>'list',
        'acl_module'=>'Accounts',
        'icon' => 'fa-list-alt',
    ),
    array(
        'route'=>'#'.$module_name.'/views/index',
        'label' =>'Example Dotb7 Views',
        'acl_action'=>'list',
        'acl_module'=>'Accounts',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#'.$module_name.'/layout/records',
        'label' =>'Default Module List Layout',
        'acl_action'=>'list',
        'acl_module'=>'Accounts',
        'icon' => 'fa-columns',
    ),
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'Default Record Create Layout',
        'acl_action'=>'list',
        'acl_module'=>'Accounts',
        'icon' => 'fa-plus',
    ),
);
