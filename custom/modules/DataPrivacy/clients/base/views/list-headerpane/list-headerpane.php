<?php


$viewdefs['DataPrivacy']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_DATAPRIVACY',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_DATAPRIVACY',
			'tooltip' => 'LNK_NEW_DATAPRIVACY',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'DataPrivacy',
            'route'=>'#DataPrivacy/create',
            'icon' => 'fa-plus',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);