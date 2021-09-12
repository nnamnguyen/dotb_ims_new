<?php


$module_name = 'Project';
$viewdefs[$module_name]['base']['menu']['quickcreate'] = array(
    'layout' => 'create',
    'label' => 'LNK_NEW_PROJECT',
    'visible' => false,
    'icon' => 'fa-plus',
    'related' => array(
        array(
            'module' => 'Accounts',
            'link' => 'project',
        ),
        array(
            'module' => 'Contacts',
            'link' => 'project',
        ),
        array(
            'module' => 'Opportunities',
            'link' => 'project',
        ),
        array(
            'module' => 'Tasks',
            'link' => 'project',
        ),
        array(
            'module' => 'Meetings',
            'link' => 'project',
        ),
        array(
            'module' => 'Calls',
            'link' => 'project',
        ),
        array(
            'module' => 'Cases',
            'link' => 'project',
        ),
    ),

);
