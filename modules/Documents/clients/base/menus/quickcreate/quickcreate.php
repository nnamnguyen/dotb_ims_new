<?php


$module_name = 'Documents';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_DOCUMENT',
    'visible' => true,
    'order' => 4,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Accounts',
            'link' => 'documents',
        ),
        array(
            'module' => 'Contacts',
            'link' => 'documents',
        ),
        array(
            'module' => 'Opportunities',
            'link' => 'documents',
        ),
        array(
            'module' => 'RevenueLineItems',
            'link' => 'documents',
        ),
    ),
);
