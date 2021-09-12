<?php

$module_name = 'EmailMarketing';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#Campaigns/create',
        'label' =>'LNK_NEW_CAMPAIGN',
        'acl_action'=>'create',
        'acl_module'=>'Campaigns',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#Campaigns/',
        'label' =>'LNK_NEW_CAMPAIGN',
        'acl_action'=>'list',
        'acl_module'=>'Campaigns',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#ProspectLists/create',
        'label' =>'LNK_NEW_PROSPECT_LIST',
        'acl_action'=>'create',
        'acl_module'=>'ProspectLists',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#ProspectLists/',
        'label' =>'LNK_NEW_PROSPECT_LIST',
        'acl_action'=>'list',
        'acl_module'=>'ProspectLists',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#Prospects/create',
        'label' =>'LNK_NEW_PROSPECT',
        'acl_action'=>'create',
        'acl_module'=>'Prospects',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#Prospects/',
        'label' =>'LNK_NEW_PROSPECT',
        'acl_action'=>'list',
        'acl_module'=>'Prospects',
        'icon' => 'fa-bars',
    ),
);
