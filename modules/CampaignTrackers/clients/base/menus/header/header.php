<?php

$module_name = 'CampaignTrackers';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#Campaigns/',
        'label' =>'LNK_CAMPAIGN_LIST',
        'acl_action'=>'list',
        'acl_module'=>'Campaigns',
        'icon' => 'fa-bars',
    ),
);
