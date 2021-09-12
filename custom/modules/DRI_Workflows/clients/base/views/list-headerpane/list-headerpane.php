<?php


$viewdefs['DRI_Workflows']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_DRI_WORKFLOWS',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_RECORD',
			'tooltip' => 'LNK_NEW_RECORD',
            'acl_action' => 'edit',
            'type' => 'button',
            'acl_module' => 'DRI_Workflows',
            'route'=>'#DRI_Workflows/create',
            'icon' => 'fa-plus',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);