<?php



$moduleName = 'ACLRoles';
$viewdefs[$moduleName]['base']['menu']['header'] = array(
    array(
        'route' => "#bwc/index.php?module=$moduleName&action=EditView",
        'label' => 'LBL_CREATE_ROLE',
        'acl_module' => $moduleName,
        'acl_action' => 'edit',
        'icon' => 'fa-plus',
    ),
    array(
        'route' => "#bwc/index.php?module=$moduleName&action=index",
        'label' => 'LIST_ROLES',
        'acl_module' => $moduleName,
        'acl_action' => 'list',
        'icon' => 'fa-bars',
    ),
    array(
        'route' => "#bwc/index.php?module=$moduleName&action=ListUsers",
        'label' => 'LIST_ROLES_BY_USER',
        'acl_module' => $moduleName,
        'acl_action' => 'list',
        'icon' => 'fa-bars',
    ),
);
