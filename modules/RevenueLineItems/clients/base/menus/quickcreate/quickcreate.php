<?php


$module_name = 'RevenueLineItems';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_REVENUELINEITEM',
    'visible' => true,
    'order' => 10,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Accounts',
            'link' => 'revenuelineitems',
        ),
        array(
            'module' => 'Contacts',
            'link' => 'revenuelineitems',
        ),
        array(
            'module' => 'Opportunities',
            'link' => 'revenuelineitems',
        ),
    ),
);
