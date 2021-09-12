<?php

$module_name = 'Bugs';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_BUG',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_BUG_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route' => '#Reports?filterModule=' . $module_name,
        'label' =>'LNK_BUG_REPORTS',
        'acl_action'=>'list',
        'acl_module' => 'Reports',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Bugs&return_module=Bugs&return_action=index',
        'label' =>'LNK_IMPORT_BUGS',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
