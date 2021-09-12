<?php



$viewdefs['WorkFlow']['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=WorkFlow&action=EditView&return_module=WorkFlow&return_action=DetailView',
        'label' =>'LNK_NEW_WORKFLOW',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=WorkFlow&action=index&return_module=WorkFlow&return_action=DetailView',
        'label' =>'LNK_WORKFLOW',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=WorkFlow&action=WorkFlowListView&return_module=WorkFlow&return_action=index',
        'label' =>'LNK_ALERT_TEMPLATES',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-magic',
    ),
    array(
        'route'=>'#bwc/index.php?module=WorkFlow&action=ProcessListView&return_module=WorkFlow&return_action=index',
        'label' =>'LNK_PROCESS_VIEW',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-sitemap',
    ),
);
