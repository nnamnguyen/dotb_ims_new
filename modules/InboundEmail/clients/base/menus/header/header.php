<?php

$module_name = 'InboundEmail';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=InboundEmail&action=EditView',
        'label' =>'LNK_LIST_CREATE_NEW_GROUP',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=InboundEmail&action=EditView&mailbox_type=bounce',
        'label' =>'LNK_LIST_CREATE_NEW_BOUNCE',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=InboundEmail&action=index',
        'label' =>'LNK_LIST_MAILBOXES',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Schedulers&action=index',
        'label' =>'LNK_LIST_SCHEDULER',
        'acl_action'=>'admin',
        'acl_module'=>'Schedulers',
        'icon' => 'fa-clock-o',
    ),
);
