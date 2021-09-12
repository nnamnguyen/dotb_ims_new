<?php

$module_name = 'Project';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=Project&action=EditView&return_module=Project&return_action=DetailView',
        'label' =>'LNK_NEW_PROJECT',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=Project&action=ProjectTemplatesEditView&return_module=Project&return_action=ProjectTemplatesDetailView',
        'label' =>'LNK_NEW_PROJECT_TEMPLATES',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#bwc/index.php?module=Project&action=index',
        'label' =>'LNK_PROJECT_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    // Project Templates
    array(
        'route'=>'#bwc/index.php?module=Project&action=ProjectTemplatesListView',
        'label' =>'LNK_PROJECT_TEMPLATES_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=ProjectTask&action=index',
        'label' =>'LNK_PROJECT_TASK_LIST',
        'acl_action'=>'list',
        'acl_module'=>'ProjectTask',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Project&action=Dashboard&return_module=Project&return_action=DetailView',
        'label' =>'LNK_PROJECT_DASHBOARD',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
);
