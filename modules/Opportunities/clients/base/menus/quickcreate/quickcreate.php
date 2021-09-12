<?php


$module_name = 'Opportunities';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_OPPORTUNITY',
    'visible' => true,
    'order' => 2,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Accounts',
            'link' => 'opportunities',
        ),
        array(
            'module' => 'Contacts',
            'link' => 'opportunities',
        ),
    ),
);
