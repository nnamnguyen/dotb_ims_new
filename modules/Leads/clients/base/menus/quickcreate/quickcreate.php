<?php


$module_name = 'Leads';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_LEAD',
    'visible' => true,
    'order' => 3,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Accounts',
            'link' => 'leads',
        ),
        array(
            'module' => 'Contacts',
            'link' => 'leads',
        ),
        array(
            'module' => 'Opportunities',
            'link' => 'leads',
        ),
    ),
);
