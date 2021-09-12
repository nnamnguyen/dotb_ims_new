<?php
global $current_user;
$viewdefs['base']['view']['profileactions'] = array(
    array(
        'route' => '#profile',
        'label' => 'LBL_PROFILE',
        'css_class' => 'profileactions-profile',
        'acl_action' => 'view',
        'icon' => 'fa-user',
    ),
    array(
        'route' => '#bwc/index.php?module=Users&action=index',
        'label' => 'LBL_USER',
        'css_class' => 'profileactions-employees',
        'module' => 'Administration',
        'acl_action' => 'admin',
        'icon' => 'fa-user-cog',
    ),
    array(
        'route' => '#bwc/index.php?module=Teams&action=index',
        'label' => 'LBL_MANAGE_TEAMS_TITLE',
        'css_class' => 'profileactions-employees',
        'module' => 'Teams',
        'acl_action' => 'admin',
        'icon' => 'fa-users',
    ),
    array(
        'route' => '#bwc/index.php?module=Administration&action=index',
        'label' => 'LBL_ADMIN',
        'css_class' => 'administration',
        'module' => 'Administration',
        'acl_action' => 'admin',
        'icon' => 'fa-cogs',
    ),
//    array(
//        'route' => '#C_AdminConfig/layout/translate_languages',
//        'label' => 'LBL_TRANSLATE_LANGUAGES',
//        'css_class' => 'administration',
//        'module' => 'Contacts',
//        'acl_action' => 'view',
//        'icon' => 'fa-globe',
//    ),
);

if ($current_user->id == '1') {
    $viewdefs['base']['view']['profileactions'][] = array(
        'route' => '#bwc/index.php?module=ModuleBuilder&action=index&type=studio',
        'label' => 'LBL_STUDIO',
        'css_class' => 'administration',
        'module' => 'Administration',
        'acl_action' => 'admin',
        'icon' => 'fa-tasks',
    );
    $viewdefs['base']['view']['profileactions'][] = array(
        'route' => '#bwc/index.php?module=Administration&action=Upgrade',
        'label' => 'LBL_REPAIR',
        'css_class' => 'administration',
        'module' => 'Administration',
        'acl_action' => 'admin',
        'icon' => 'fa-wrench',
    );
    $viewdefs['base']['view']['profileactions'][] = array(
        'route' => '#bwc/index.php?module=Administration&action=ConfigureTabs',
        'label' => 'LBL_CONFIG_TABS',
        'css_class' => 'administration',
        'module' => 'Administration',
        'acl_action' => 'admin',
        'icon' => 'fa-cog',
    );
}
$viewdefs['base']['view']['profileactions'][] = array(
    'route' => '#logout/?clear=1',
    'label' => 'LBL_LOGOUT',
    'css_class' => 'profileactions-logout',
    'icon' => 'fa-sign-out',
);