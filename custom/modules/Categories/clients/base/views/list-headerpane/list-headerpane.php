<?php


$viewdefs['Categories']['base']['view']['list-headerpane'] = array(
    'title' => 'LBL_CATEGORIES',
    'buttons' => array(

        array(



            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Categories',
            'route'=>'#Categories/create',
            'icon' => 'fa-folder-plus',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);