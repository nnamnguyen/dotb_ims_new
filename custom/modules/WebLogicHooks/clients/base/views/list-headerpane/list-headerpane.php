<?php


$viewdefs['WebLogicHooks']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_LOGIC_HOOK',
			'tooltip' => 'LNK_NEW_LOGIC_HOOK',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'WebLogicHooks',
            'route'=>'#WebLogicHooks/create',
            'icon' => 'fa-plus',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
