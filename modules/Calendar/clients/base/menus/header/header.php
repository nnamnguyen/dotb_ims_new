<?php

$module_name = 'Calendar';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#Meetings/create',
        'label' =>'LNK_NEW_MEETING',
        'acl_action'=>'create',
        'acl_module'=>'Meetings',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#Calls/create',
        'label' =>'LNK_NEW_CALL',
        'acl_action'=>'create',
        'acl_module'=>'Calls',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#Tasks/create',
        'label' =>'LNK_NEW_TASK',
        'acl_action'=>'create',
        'acl_module'=>'Tasks',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=Calendar&action=index&view=day',
        'label' =>'LNK_VIEW_CALENDAR',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
);
