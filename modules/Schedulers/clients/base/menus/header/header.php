<?php

$module_name = 'Schedulers';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=Schedulers&action=EditView',
        'label' =>'LNK_NEW_SCHEDULER',
        'acl_action'=>'admin',
        'acl_module'=>'',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=Schedulers&action=index',
        'label' =>'LNK_LIST_SCHEDULER',
        'acl_action'=>'admin',
        'acl_module'=>'',
        'icon' => 'fa-list',
    ),
);
