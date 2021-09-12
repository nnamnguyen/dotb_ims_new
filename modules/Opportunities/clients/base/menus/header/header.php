<?php

$module_name = 'Opportunities';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_OPPORTUNITY',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_OPPORTUNITY_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route' => '#Reports?filterModule=' . $module_name,
        'label' =>'LNK_OPPORTUNITY_REPORTS',
        'acl_action'=>'list',
        'acl_module' => 'Reports',
        'icon' => 'fa-user-chart',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Opportunities&return_module=Opportunities&return_action=index',
        'label' =>'LNK_IMPORT_OPPORTUNITIES',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
