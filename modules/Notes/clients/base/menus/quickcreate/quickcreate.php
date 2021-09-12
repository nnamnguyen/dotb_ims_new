<?php


$module_name = 'Notes';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_NOTE',
    'visible' => true,
    'order' => 9,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Contacts',
            'link' => 'notes',
        ),
    ),
);
