<?php


$viewdefs['ProspectLists']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_PROSPECT_LIST',
			'tooltip' => 'LNK_NEW_PROSPECT_LIST',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'ProspectLists',
            'route'=>'#ProspectLists/create',
            'icon' => 'fa-plus',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
