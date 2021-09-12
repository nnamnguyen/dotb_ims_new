<?php

$module_name = 'Leads';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_LEAD',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name.'/vcard-import',
        'label' =>'LNK_IMPORT_VCARD',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_LEAD_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route' => '#Reports?filterModule=' . $module_name,
        'label' =>'LNK_LEAD_REPORTS',
        'acl_action'=>'list',
        'acl_module' => 'Reports',
        'icon' => 'fa-user-chart',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Leads&return_module=Leads&return_action=index',
        'label' =>'LNK_IMPORT_LEADS',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
