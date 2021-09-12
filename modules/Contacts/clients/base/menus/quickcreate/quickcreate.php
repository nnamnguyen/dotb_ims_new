<?php


$module_name = 'Contacts';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_CONTACT',
    'visible' => true,
    'order' => 1,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Accounts',
            'link' => 'contacts',
        ),
        array(
            'module' => 'Opportunities',
            'link' => 'contacts',
        ),
    ),
);
