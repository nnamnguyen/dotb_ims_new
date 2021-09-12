<?php

$module_name = 'Notes';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_NOTE',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_NOTE_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Notes&return_module=Notes&return_action=index',
        'label' =>'LNK_IMPORT_NOTES',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
