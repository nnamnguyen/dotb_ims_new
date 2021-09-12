<?php

$module_name = 'RevenueLineItems';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_REVENUELINEITEM',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_REVENUELINEITEM_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=RevenueLineItems&return_module=RevenueLineItems&return_action=index',
        'label' =>'LNK_IMPORT_REVENUELINEITEMS',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
