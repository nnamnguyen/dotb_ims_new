<?php


$viewdefs['KBContents']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_KBCONTENTS',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_ARTICLE',
			'tooltip' => 'LNK_NEW_ARTICLE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'KBContents',
            'route'=>'#KBContents/create',
            'icon' => 'fa-plus',
        ),
        array(


            'label' => 'LNK_LIST_KBCONTENT_TEMPLATES',
			'tooltip' => 'LNK_LIST_KBCONTENT_TEMPLATES',
            'acl_action' => 'admin',
            'type' => 'button',
            'acl_module' => 'KBContents',
            'route'=>'##KBContentTemplates',
            'icon' => 'fa-reorder',
        ),
        array(


            'label' => 'LNK_KNOWLEDGE_BASE_ADMIN_MENU',
			'tooltip' => 'LNK_KNOWLEDGE_BASE_ADMIN_MENU',
            'acl_action' => 'admin',
            'type' => 'button',
            'acl_module' => 'KBContents',
            'route'=>'#KBContents/config',
            'icon' => 'fa-cog',
        ),


        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);