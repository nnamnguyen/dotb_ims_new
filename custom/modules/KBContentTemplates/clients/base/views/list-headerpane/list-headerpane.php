<?php


$viewdefs['KBContentTemplates']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_PMSE_MY_PROCESSES',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_KBCONTENT_TEMPLATE',
			'tooltip' => 'LNK_NEW_KBCONTENT_TEMPLATE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'KBContentTemplates',
            'route'=>'#KBContentTemplates/create',
            'icon' => 'fa-plus',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);