<?php

$module_name = 'Bugs';
$viewdefs[$module_name]['portal']['menu']['header'] = array(
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
);
