<?php
$moduleName = 'Teams';
$viewdefs[$moduleName]['base']['menu']['header'] = array(
    array(
        'route' => "#$moduleName",
        'label' => 'LNK_LIST_TEAM',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
	array(
        'route' => "#ACLRoles",
        'label' => 'LNK_ROLE',
        'acl_action' => 'list',
        'acl_module' => 'ACLRoles',
        'icon' => 'fa-sitemap',
    ),
	array(
        'route' => "#Users",
        'label' => 'LNK_USER',
        'acl_action' => 'list',
        'acl_module' => 'Users',
        'icon' => 'fa-users',
    ),
);
