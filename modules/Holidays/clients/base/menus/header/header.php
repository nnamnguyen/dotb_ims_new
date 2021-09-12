<?php

$module_name = 'Holidays';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_HOLIDAY',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_HOLIDAYS',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => '',
    ),
);
