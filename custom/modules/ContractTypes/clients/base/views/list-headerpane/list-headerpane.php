<?php


$viewdefs['ContractTypes']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_CONTRACT_TYPES',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_CONTRACTTYPE',
			'tooltip' => 'LNK_NEW_CONTRACTTYPE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'ContractTypes',
            'route'=>'#ContractTypes/create',
            'icon' => 'fa-plus',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);