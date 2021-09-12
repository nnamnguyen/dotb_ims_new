<?php



$module_name = 'OAuthKeys';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => "#bwc/index.php?module=$module_name&action=EditView&return_module=$module_name&return_action=DetailView",
        'label' => 'LNK_NEW_RECORD',
        'acl_action' => 'create',
        'acl_module' => $module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => "#bwc/index.php?module=$module_name&action=index",
        'label' => 'LNK_LIST',
        'acl_action' => 'list',
        'acl_module' => $module_name,
        'icon' => 'fa-bars',
    ),
);
