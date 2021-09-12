<?php

$module_name = 'Contracts';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#Contracts/create',
        'label' =>'LNK_NEW_CONTRACT',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#Contracts',
        'label' =>'LNK_CONTRACT_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Contracts&return_module=Contracts&return_action=index',
        'label' =>'LNK_IMPORT_CONTRACTS',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
