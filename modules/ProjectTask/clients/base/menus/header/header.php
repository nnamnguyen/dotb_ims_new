<?php


$module_name = 'ProjectTask';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=Project&action=EditView&return_module=Project&return_action=DetailView',
        'label' =>'LNK_NEW_PROJECT',
        'acl_action'=>'create',
        'acl_module'=>'Project',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=Project&action=index',
        'label' =>'LNK_PROJECT_LIST',
        'acl_action'=>'list',
        'acl_module'=>'Project',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=ProjectTask&action=index',
        'label' =>'LNK_PROJECT_TASK_LIST',
        'acl_action'=>'list',
        'acl_module'=>'Project',
        'icon' => 'fa-bars',
    ),
);
