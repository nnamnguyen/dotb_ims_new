<?php


$viewdefs['portal']['view']['profileactions'] = array(
    array(
        'route' => '#profile',
        'label' => 'LBL_PROFILE',
        'css_class' => 'profileactions-profile',
        'acl_action' => 'view',
        'icon' => 'fa-user',
    ),
    array(
        'route' => '#logout/?clear=1',
        'label' => 'LBL_LOGOUT',
        'icon' => 'fa-sign-out',
    ),
);
